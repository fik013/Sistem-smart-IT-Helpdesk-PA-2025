<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssetCategory;

use App\Models\SawCriteria;
use App\Models\SawSubCriteria;

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
            'weight' => 'required|numeric|min:0|max:1',
        ]);

        $category = AssetCategory::create($request->all());

        // Sync with SAW SubCriteria (C2 - Jenis Aset)
        $criteria = SawCriteria::where('code', 'C2')->first();
        if ($criteria) {
            SawSubCriteria::create([
                'saw_criteria_id' => $criteria->id,
                'name' => $category->name,
                'weight' => $category->weight,
            ]);
        }

        return redirect()->route('admin.asset-categories.index')
            ->with('success', 'Kategori aset berhasil ditambahkan dan disinkronkan dengan SAW.');
    }

    public function update(Request $request, AssetCategory $assetCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:asset_categories,name,' . $assetCategory->id,
            'description' => 'nullable|string',
            'weight' => 'required|numeric|min:0|max:1',
        ]);

        $oldName = $assetCategory->name;
        $assetCategory->update($request->all());

        // Sync with SAW SubCriteria
        $criteria = SawCriteria::where('code', 'C2')->first();
        if ($criteria) {
            $subCriteria = SawSubCriteria::where('saw_criteria_id', $criteria->id)
                ->where('name', $oldName)
                ->first();

            if ($subCriteria) {
                $subCriteria->update([
                    'name' => $assetCategory->name,
                    'weight' => $assetCategory->weight,
                ]);
            } else {
                // If not found (maybe manually deleted?), create new
                SawSubCriteria::create([
                    'saw_criteria_id' => $criteria->id,
                    'name' => $assetCategory->name,
                    'weight' => $assetCategory->weight,
                ]);
            }
        }

        return redirect()->route('admin.asset-categories.index')
            ->with('success', 'Kategori aset berhasil diperbarui dan disinkronkan dengan SAW.');
    }

    public function destroy(AssetCategory $assetCategory)
    {
        // Sync Delete SAW
        $criteria = SawCriteria::where('code', 'C2')->first();
        if ($criteria) {
            SawSubCriteria::where('saw_criteria_id', $criteria->id)
                ->where('name', $assetCategory->name)
                ->delete();
        }

        $assetCategory->delete();

        return redirect()->route('admin.asset-categories.index')
            ->with('success', 'Kategori aset berhasil dihapus.');
    }
}
