<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Fichero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class FicheroController extends Controller
{
    /**
     * Maneja la subida de un archivo.
     */
    public function upload(Request $request)
    {
        // Validar el archivo subido
        $request->validate([
            'uploaded_file' => 'required|file|max:10240', // 10MB
            'visibility' => 'required|in:public,private',
        ]);

        // Crear una nueva instancia de Fichero
        $fichero = new Fichero();

        // Guardar el archivo y almacenar la ruta en la base de datos
        $fichero->path = $request->file('uploaded_file')->store('uploads', 'private');
        $fichero->name = $request->file('uploaded_file')->getClientOriginalName();
        $fichero->visibility = $request->visibility;
        $fichero->user_id = Auth::id();

        // Guardar en la base de datos
        $fichero->save();

        return redirect()->back()->with('success', 'Fichero subido correctamente');
    }

    /**
     * Previsualización de un archivo.
     */
    public function preview(Fichero $file)
    {
        // Verificar permisos para acceder al archivo
        if ($file->visibility === 'private' && Auth::id() !== $file->user_id) {
            abort(403, 'No tienes permiso para acceder a este archivo.');
        }
    
        // Verificar que el archivo exista
        if (!Storage::disk('private')->exists($file->path)) {
            abort(404, 'El archivo no existe.');
        }
    
        // Preparar datos para la vista
        $comments = Comment::where('file_id', $file->id)
            ->whereNull('parent_id')
            ->with('replies')
            ->paginate(2);
    
        $fileSize = number_format(Storage::size($file->path) / 1024, 2);
        $fileType = pathinfo($file->name, PATHINFO_EXTENSION);
    
        return view('file_preview', compact('file', 'comments', 'fileSize', 'fileType'));
    }

    /**
     * Maneja la descarga de un archivo.
     */
    public function download(Fichero $file)
    {
        // Verificar si el usuario tiene permiso para descargar
        if ($file->visibility === 'private' && Auth::id() !== $file->user_id) {
            return redirect()->back()->with('error', 'No tienes permiso para descargar este archivo.');
        }

        // Verificar si el archivo existe
        if (!Storage::disk('private')->exists($file->path)) {
            return redirect()->back()->with('error', 'El archivo no existe o ha sido eliminado.');
        }

        // Retornar el archivo como respuesta de descarga
        return response()->download(Storage::disk('private')->path($file->path), $file->name);
    }

    /**
     * Maneja la eliminación de un archivo.
     */
    public function delete(Fichero $file)
    {
        // Eliminar el archivo del almacenamiento
        Storage::delete($file->path);

        // Eliminar el registro en la base de datos
        $file->delete();

        return redirect('/')->with('success', 'Fichero eliminado correctamente');
    }
    public function serveContent(Fichero $file)
    {
        // Verificar permisos para acceder al archivo
        if ($file->visibility === 'private' && Auth::id() !== $file->user_id) {
            abort(403, 'No tienes permiso para acceder a este archivo.');
        }

        // Obtener la ruta completa del archivo
        $filePath = Storage::disk('private')->path($file->path);

        // Verificar si el archivo existe
        if (!file_exists($filePath)) {
            abort(404, 'El archivo no existe.');
        }

        // Devolver el archivo como respuesta para previsualización
        return Response::file($filePath, [
            'Content-Type' => mime_content_type($filePath),
            'Content-Disposition' => 'inline',
        ]);
    }

}
