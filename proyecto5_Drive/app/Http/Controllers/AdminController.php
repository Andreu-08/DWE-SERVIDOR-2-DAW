<?php

namespace App\Http\Controllers;

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
}

