<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AssetCategory;
use App\Models\Department;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = \App\Models\Inventory::query();

        // Base Query: User's items OR Department's items
        $query->where(function($q) use ($user) {
            $q->where('user_id', $user->id);
            
            if ($user->department) {
                // Find department by name as user->department stores the name
                $dept = Department::where('name', $user->department)->first();
                if ($dept) {
                     $q->orWhere('department_id', $dept->id);
                }
            }
        });

        $query->latest();

        // Search Filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('item_name', 'like', "%{$search}%")
                  ->orWhere('serial_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Category Filter
        if ($request->filled('category') && $request->category !== 'all') {
            $category = $request->category;
            $query->where('asset_category_id', $category);
        }

        $inventories = $query->get();
        $categories = AssetCategory::all();

        return view('user.inventory.index', compact('inventories', 'categories'));
    }
    public function show($id)
    {
        $inventory = \App\Models\Inventory::with(['category', 'department', 'user'])->findOrFail($id);
        
        // Authorization check: User can only view their own or their department's inventory
        $user = Auth::user();
        $hasAccess = false;
        
        if ($inventory->user_id == $user->id) {
            $hasAccess = true;
        } elseif ($user->department) {
            $dept = Department::where('name', $user->department)->first();
            if ($dept && $inventory->department_id == $dept->id) {
                $hasAccess = true;
            }
        }
        
        if (!$hasAccess) {
             abort(403, 'Unauthorized access to this inventory item.');
        }

        return view('user.inventory.show', compact('inventory'));
    }
}
