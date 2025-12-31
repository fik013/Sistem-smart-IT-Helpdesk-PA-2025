<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssetCategory;

class AssetCategoryController extends Controller
{
    public function index()
    {
        $categories = AssetCategory::latest()->paginate(10);
        return view('admin.asset-categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:asset_categories',
            'description' => 'nullable|string',
        ]);

        AssetCategory::create($request->all());

        return redirect()->route('admin.asset-categories.index')
            ->with('success', 'Kategori aset berhasil ditambahkan.');
    }

    public function update(Request $request, AssetCategory $assetCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:asset_categories,name,' . $assetCategory->id,
            'description' => 'nullable|string',
        ]);

        $assetCategory->update($request->all());

        return redirect()->route('admin.asset-categories.index')
            ->with('success', 'Kategori aset berhasil diperbarui.');
    }

    public function destroy(AssetCategory $assetCategory)
    {
        $assetCategory->delete();

        return redirect()->route('admin.asset-categories.index')
            ->with('success', 'Kategori aset berhasil dihapus.');
    }
}
