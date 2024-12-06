<?php

namespace App\Http\Controllers;

use App\Models\UserAction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Mostrar la vista de administración.
     */
    public function index()
    {
        return view('admin.dashboard'); // Crea esta vista en resources/views/admin/dashboard.blade.php
    }

    public function dashboard(Request $request)
    {
        $query = UserAction::with('user', 'file');

        if ($request->has('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('search') . '%');
            });
        }

        $actions = $query->paginate(10);

        return view('admin.dashboard', compact('actions'));
    }
}

