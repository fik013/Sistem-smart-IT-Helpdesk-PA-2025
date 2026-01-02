<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\AssetCategory;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::with(['user', 'department', 'category'])->latest()->paginate(10);
        return view('admin.inventory.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $departments = Department::all();
        $categories = AssetCategory::all();
        return view('admin.inventory.create', compact('users', 'departments', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'owner_type' => 'required|in:user,department',
            'user_id' => 'required_if:owner_type,user|nullable|exists:users,id',
            'department_id' => 'required_if:owner_type,department|nullable|exists:departments,id',
            'asset_category_id' => 'required|exists:asset_categories,id',
            'item_name' => 'required|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive,maintenance',
            'image' => 'nullable|image|max:2048',
        ]);

        // Clean up data based on type
        if ($request->owner_type === 'user') {
            $validated['department_id'] = null;
        } else {
            $validated['user_id'] = null;
        }
        unset($validated['owner_type']);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('inventory-images', 'public');
        }

        Inventory::create($validated);

        return redirect()->route('admin.inventory.index')->with('success', 'Inventaris berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        $users = User::all();
        $departments = Department::all();
        $categories = AssetCategory::all();
        return view('admin.inventory.edit', compact('inventory', 'users', 'departments', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            'owner_type' => 'required|in:user,department',
            'user_id' => 'required_if:owner_type,user|nullable|exists:users,id',
            'department_id' => 'required_if:owner_type,department|nullable|exists:departments,id',
            'asset_category_id' => 'required|exists:asset_categories,id',
            'item_name' => 'required|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive,maintenance',
            'image' => 'nullable|image|max:2048',
        ]);

        // Clean up data based on type
        if ($request->owner_type === 'user') {
            $validated['department_id'] = null;
        } else {
            $validated['user_id'] = null;
        }
        unset($validated['owner_type']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($inventory->image_path) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($inventory->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('inventory-images', 'public');
        }

        $inventory->update($validated);

        return redirect()->route('admin.inventory.index')->with('success', 'Inventaris berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return redirect()->route('admin.inventory.index')->with('success', 'Inventaris berhasil dihapus.');
    }
}
