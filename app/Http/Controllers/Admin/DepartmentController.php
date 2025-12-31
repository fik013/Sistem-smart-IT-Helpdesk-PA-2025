<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;

use App\Models\SawCriteria;
use App\Models\SawSubCriteria;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('admin.departments.index', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0|max:1',
            'description' => 'nullable|string',
        ]);

        $department = Department::create($request->all());

        // Sync to SAW Sub-Criteria
        $this->syncSawSubCriteria('create', $department);

        return redirect()->back()->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0|max:1',
            'description' => 'nullable|string',
        ]);

        $oldName = $department->name;
        $department->update($request->all());

        if ($oldName !== $department->name) {
            \App\Models\User::where('department', $oldName)->update(['department' => $department->name]);
        }

        // Sync to SAW Sub-Criteria
        $this->syncSawSubCriteria('update', $department, $oldName);

        return redirect()->back()->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy(Department $department)
    {
        $name = $department->name;
        $department->delete();
        
        \App\Models\User::where('department', $name)->update(['department' => null]);

        // Sync to SAW Sub-Criteria
        $this->syncSawSubCriteria('delete', $department);

        return redirect()->back()->with('success', 'Jabatan berhasil dihapus.');
    }

    /**
     * Sync Department changes to SAW Sub-Criteria table for "Jabatan" related criteria.
     */
    private function syncSawSubCriteria($action, $department, $oldName = null)
    {
        // Find SAW Criteria related to "Jabatan" or "Jabatan Pengguna"
        $criteria = SawCriteria::where('name', 'LIKE', '%Jabatan%')->first();

        if (!$criteria) {
            return;
        }

        if ($action === 'create') {
            SawSubCriteria::create([
                'saw_criteria_id' => $criteria->id,
                'name' => $department->name,
                'weight' => $department->weight,
            ]);
        } elseif ($action === 'update') {
            // Find existing sub-criteria by old name (or current name if not changed)
            $searchName = $oldName ?? $department->name;
            $subCriteria = SawSubCriteria::where('saw_criteria_id', $criteria->id)
                ->where('name', $searchName)
                ->first();
            
            if ($subCriteria) {
                $subCriteria->update([
                    'name' => $department->name,
                    'weight' => $department->weight,
                ]);
            } else {
                // If not found, create it (fallback)
                SawSubCriteria::create([
                    'saw_criteria_id' => $criteria->id,
                    'name' => $department->name,
                    'weight' => $department->weight,
                ]);
            }
        } elseif ($action === 'delete') {
            SawSubCriteria::where('saw_criteria_id', $criteria->id)
                ->where('name', $department->name)
                ->delete();
        }
    }
}
