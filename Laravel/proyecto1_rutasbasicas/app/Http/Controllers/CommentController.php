<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Función que inicializa los comentarios en la sesión si no existen
    private function initSession(Request $request)
    {
        if (!$request->session()->has('comentarios')) {
            $request->session()->put('comentarios', [
                "Comentario 1",
                "Comentario 2",
                "Comentario 3",
            ]);
        }
    }

    public function index(Request $request)
    {
        // Inicializar la sesión si es necesario
        $this->initSession($request);

        // Obtener los comentarios desde la sesión
        $comentarios = $request->session()->get('comentarios');

        // Generar el HTML para mostrar los comentarios
        return view('index')
            ->with('superarray', session('comentarios'))
        ;
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        // Inicializar la sesión si es necesario
        $this->initSession($request);

        // Obtener los comentarios desde la sesión
        $comentarios = $request->session()->get('comentarios');

        // Agregar el nuevo comentario al array de la sesión
        array_push($comentarios, $request->comentario);

        // Guardar el array de nuevo en la sesión
        $request->session()->put('comentarios', $comentarios);

        // Redirigir a la lista de comentarios
        return redirect('/comments');
    }

    public function show(Request $request, string $commentid)
    {
        
        return view('show')
            ->with('texto', session('comentarios')[$commentid]) 
            ->with('id', $commentid)
            ;

    }

    public function edit(Request $request, string $commentid)
    {
        // Obtener los comentarios desde la sesión
        $comentarios = $request->session()->get('comentarios');

        return view('edit')
            ->with('id',$commentid )
            ->with('texto', session('comentarios')[$commentid]) 
            ;
    }

    public function update(Request $request, string $commentid)
    {
        // Obtener los comentarios desde la sesión
        $comentarios = $request->session()->get('comentarios');

        // Actualizar el comentario en la posición especificada
        $comentarios[$commentid] = $request->comment;

        // Guardar el array de nuevo en la sesión
        $request->session()->put('comentarios', $comentarios);

        // Redirigir a la lista de comentarios actualizada
        return redirect('/comments');
    }

    public function destroy(Request $request, string $commentid)
    {
        // Obtener los comentarios desde la sesión
        $comentarios = $request->session()->get('comentarios');

        // Eliminar el comentario en la posición indicada
        unset($comentarios[$commentid]);

        // Reindexar el array para evitar huecos en los índices
        $comentarios = array_values($comentarios);

        // Guardar el array de nuevo en la sesión
        $request->session()->put('comentarios', $comentarios);

        // Redirigir a la lista de comentarios actualizada
        return redirect('/comments');
    }
}
