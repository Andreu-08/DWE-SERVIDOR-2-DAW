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
        $fichero->path = $request->file('uploaded_file')->store('uploads', 'public');
        $fichero->name = $request->file('uploaded_file')->getClientOriginalName();
        $fichero->visibility = $request->visibility;
        $fichero->user_id = Auth::id();
        
        // Guardar en la base de datos
        $fichero->save();

        return redirect()->back()->with('success', 'Fichero subido correctamente');
    }
    //funcion para previsualizar los archivos
    public function preview(Fichero $file){
        // Verificar si el archivo es privado y si el usuario es el propietario
        if ($file->visibility == 'private' && Auth::id() !== $file->user_id) {
            return redirect('/')->with('error', 'No tienes permiso para ver este archivo.');
        }

        // Enviar el archivo a la vista de vista previa
        return view('file_preview', compact('file'));
    }

     /**
     * Maneja la descarga de un archivo.
     */
    public function download(Fichero $file)
    {
        // descarga el archivo
        return Storage::download($file->path, $file->name);
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
