<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;

class DepartmentController extends Controller
{
    // ... index/create/show/edit not needed if handled in modal on separate page, but for generic resource it's fine.

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0|max:1',
            'description' => 'nullable|string',
        ]);

        Department::create($request->all());

        return redirect()->route('admin.prioritas.index')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0|max:1',
            'description' => 'nullable|string',
        ]);

        $department->update($request->all());

        return redirect()->route('admin.prioritas.index')->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('admin.prioritas.index')->with('success', 'Jabatan berhasil dihapus.');
    }
}
