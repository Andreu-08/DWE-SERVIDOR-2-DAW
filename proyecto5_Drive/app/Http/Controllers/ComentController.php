<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Fichero;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class ComentController extends Controller
{
    /**
     * Almacenar un comentario en la base de datos.
     */    
    /**
     * store
     *
     * @param  mixed $request
     * @param  mixed $fileId
     * @return void
     */
    public function store(Request $request, $fileId)
    {
        // Verificar que el usuario esté autenticado
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Debes estar autenticado para comentar.');
        }

        // Validar los datos del formulario
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);
        // Buscar el archivo asociado
        $file = Fichero::findOrFail($fileId);
        
        if (Gate::denies('comment', $file)) {
            return redirect()->back()->with('error', 'No tienes permiso para comentar en este archivo.');
        }
        // Crear el comentario
        $comment = new Comment();
        $comment->content = $request->input('content'); // Usar el nombre correcto del campo
        $comment->user_id = Auth::id(); // Usuario autenticado
        $comment->file_id = $file->id;
        $comment->save();
    
        // Redirigir a la vista de previsualización del archivo con un mensaje de éxito
        return redirect("/preview/{$fileId}")->with('success', 'Comentario agregado correctamente.');
    }
        
    /**
     * show
     *
     * @param  mixed $comment
     * @return void
     */
    public function show(Comment $comment)
    {
        // Cargar el comentario y su archivo relacionado
        $file = $comment->fichero;

        return view('comments.show', [
            'comment' => $comment,
            'file' => $file,
        ]);
    }

    //funcion para eliminar un comentario    
    /**
     * destroy
     *
     * @param  mixed $comment
     * @return void
     */
    public function destroy(Comment $comment)
    {
        // Eliminar el comentario y sus respuestas anidadas
        $comment->replies()->delete(); // Elimina los comentarios anidados
        $comment->delete(); // Elimina el comentario principal
    
        return redirect()->back()->with('success', 'Comentario eliminado correctamente.');
    }
    

    //funcion reply que permite responder comentarios de forma recursiva    
    /**
     * reply
     *
     * @param  mixed $request
     * @param  mixed $comment
     * @return void
     */
    public function reply(Request $request, Comment $comment)
    {
        // Verificar que el usuario esté autenticado
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Debes estar autenticado para responder.');
        }

        // Validar el contenido de la respuesta
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Obtener el archivo relacionado directamente desde el comentario padre
        $file = Fichero::findOrFail($comment->file_id);

        // Verificar que solo el propietario del archivo pueda responder comentarios
        if ($file->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'No tienes permiso para responder a este comentario.');
        }

        // Crear la respuesta
        $reply = new Comment();
        $reply->content = $request->input('content');
        $reply->user_id = Auth::id(); // Usuario autenticado que responde
        $reply->file_id = $file->id;  // Asociar al archivo relacionado
        $reply->parent_id = $comment->id; // Relacionar con el comentario padre
        $reply->save();

        // Redirigir de vuelta a la vista de previsualización del archivo
        return redirect("/preview/{$file->id}")->with('success', 'Respuesta agregada correctamente.');
    }
    

}

