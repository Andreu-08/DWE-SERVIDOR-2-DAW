<?php

namespace App\Http\Controllers;

use App\Models\User; // Importar el modelo User
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Mostrar una lista de los usuarios.
     */
    public function index()
    {
        $users = User::all(); // Obtener todos los usuarios
        return view('users.index', compact('users')); // Retornar a la vista
    }

    /**
     * Mostrar un usuario específico.
     */
    public function show($id)
    {
        $user = User::findOrFail($id); // Buscar usuario por ID
        return view('users.show', compact('user')); // Retornar a la vista
    }

    /**
     * Mostrar el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        return view('users.create'); // Retornar vista para crear usuario
    }

    /**
     * Guardar un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:1,2',
        ]);

        // Crear el usuario
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Mostrar el formulario para editar un usuario.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Actualizar un usuario en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:1,2',
        ]);

        // Actualizar el usuario
        $user = User::findOrFail($id);
        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Eliminar un usuario.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
