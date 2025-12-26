<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Auth::user()->inventories()->latest()->get();
        return view('user.inventory.index', compact('inventories'));
    }
}
