<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SawSubCriteria;

class SawSubCriteriaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'saw_criteria_id' => 'required|exists:saw_criterias,id',
            'name' => 'required|string',
            'weight' => 'required|numeric|min:0|max:1',
        ]);

        SawSubCriteria::create($request->all());

        return redirect()->route('admin.criterias.edit', $request->saw_criteria_id)->with('success', 'Sub-Kriteria berhasil ditambahkan.');
    }

    public function update(Request $request, SawSubCriteria $subCriteria)
    {
        $request->validate([
            'weight' => 'required|numeric|min:0|max:1',
        ]);

        // Only update weight, keep name same if it's protected logic (though controller technically allows name update if passed)
        $subCriteria->update([
            'weight' => $request->weight
        ]);

        return redirect()->back()->with('success', 'Bobot Sub-Kriteria berhasil diperbarui.');
    }

    public function destroy(SawSubCriteria $subCriteria)
    {
        $criteriaId = $subCriteria->saw_criteria_id;
        $subCriteria->delete();
        return redirect()->route('admin.criterias.edit', $criteriaId)->with('success', 'Sub-Kriteria berhasil dihapus.');
    }
}
