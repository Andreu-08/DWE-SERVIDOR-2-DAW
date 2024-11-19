<?php

namespace App\Http\Controllers;

use App\Models\Fichero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    public function preview(Fichero $file)
    {
        // Verificar si el usuario tiene permiso para ver el archivo
        // Esto ya está manejado por la política 'view' en la ruta, 
        // pero es una buena práctica para garantizar seguridad adicional.
        if ($file->visibility === 'private' && (Auth::user()->id ?? null) !== $file->user_id) {
            abort(403, 'No tienes permiso para ver este archivo.');
        }
        
    
        // Pasar los datos del archivo a la vista
        return view('file_preview', [
            'file' => $file, // Modelo del archivo con todos sus datos
            'fileSize' => number_format(Storage::size($file->path) / 1024, 2), // Tamaño en KB
            'fileType' => pathinfo($file->name, PATHINFO_EXTENSION), // Extensión del archivo
        ]);
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

        // Obtener la ruta completa del archivo
        $filePath = Storage::disk('private')->path($file->path);

        // Retornar el archivo como respuesta de descarga
        return response()->download($filePath, $file->name);
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


}
