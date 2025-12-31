<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\SawCriteria;

class SawPriorityController extends Controller
{
    public function index()
    {
        $criterias = SawCriteria::all();
        $departments = Department::all();
        return view('admin.prioritas-saw.index', compact('departments', 'criterias'));
    }
}
