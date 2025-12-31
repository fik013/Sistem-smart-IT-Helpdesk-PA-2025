<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SawCriteria;

class SawCriteriaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:saw_criterias,code',
            'name' => 'required|string',
            'attribute' => 'required|in:benefit,cost',
            'weight' => 'required|numeric|min:0|max:1',
            'description' => 'nullable|string',
        ]);

        SawCriteria::create($request->all());

        return redirect()->route('admin.prioritas.index')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function edit(SawCriteria $criteria)
    {
        $criteria->load('subCriterias'); // Eager load sub criterias
        $departments = \App\Models\Department::all();
        $assetCategories = \App\Models\AssetCategory::all();
        return view('admin.prioritas-saw.edit', compact('criteria', 'departments', 'assetCategories'));
    }

    public function update(Request $request, SawCriteria $criteria)
    {
        $request->validate([
            'code' => 'required|string|unique:saw_criterias,code,' . $criteria->id,
            'name' => 'required|string',
            'attribute' => 'required|in:benefit,cost',
            'weight' => 'required|numeric|min:0|max:1',
            'description' => 'nullable|string',
        ]);

        $criteria->update($request->all());

        return redirect()->route('admin.prioritas.index')->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function destroy(SawCriteria $criteria)
    {
        $criteria->delete();
        return redirect()->route('admin.prioritas.index')->with('success', 'Kriteria berhasil dihapus.');
    }

    public function toggleStatus(SawCriteria $criteria)
    {
        $criteria->is_active = !$criteria->is_active;
        $criteria->save();

        return redirect()->back()->with('success', 'Status kriteria berhasil diperbarui.');
    }
}
