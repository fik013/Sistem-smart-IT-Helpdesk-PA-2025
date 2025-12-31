<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\AssetCategory;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::with(['user', 'category'])->latest()->paginate(10);
        return view('admin.inventory.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $categories = AssetCategory::all();
        return view('admin.inventory.create', compact('users', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'asset_category_id' => 'required|exists:asset_categories,id',
            'item_name' => 'required|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive,maintenance',
        ]);

        Inventory::create($validated);

        return redirect()->route('admin.inventory.index')->with('success', 'Inventaris berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        $users = User::all();
        $categories = AssetCategory::all();
        return view('admin.inventory.edit', compact('inventory', 'users', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'asset_category_id' => 'required|exists:asset_categories,id',
            'item_name' => 'required|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive,maintenance',
        ]);

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
