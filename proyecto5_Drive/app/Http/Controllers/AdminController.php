<?php

namespace App\Http\Controllers;

use App\Models\UserAction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $actions = UserAction::with(['user', 'file'])->get();
        return view('admin.dashboard', compact('actions'));
    }
}

