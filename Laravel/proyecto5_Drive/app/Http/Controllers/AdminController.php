<?php

namespace App\Http\Controllers;

use App\Models\UserAction;
use Illuminate\Http\Request;

/**
 * AdminController
 */
class AdminController extends Controller
{    
    /**
     * dashboard
     *
     * @return void
     */
    public function dashboard()
    {
        $actions = UserAction::with(['user', 'file'])->get();
        return view('admin.dashboard', compact('actions'));
    }
}

