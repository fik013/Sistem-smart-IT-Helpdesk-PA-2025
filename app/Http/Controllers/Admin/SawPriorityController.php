<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;

class SawPriorityController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('admin.prioritas-saw.index', compact('departments'));
    }
}
