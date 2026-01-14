<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $redirect = redirect()->route('admin.dashboard');
        } else {
            $redirect = redirect()->route('user.dashboard');
        }

        if (session('login_success')) {
            $redirect->with('login_success', true);
        }

        return $redirect;
    }
}
