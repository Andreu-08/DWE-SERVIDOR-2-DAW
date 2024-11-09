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
        // Crear una nueva instancia de Fichero
        $fichero = new Fichero();
        
        // Guardar el archivo y almacenar la ruta en la base de datos
        $fichero->path = $request->file('uploaded_file')->store('uploads'); // Guardar en la carpeta 'uploads'
        $fichero->name = $request->file('uploaded_file')->getClientOriginalName();
        $fichero->user_id = Auth::id();
        
        // Guardar en la base de datos
        $fichero->save();

        return redirect()->back()->with('success', 'Fichero subido correctamente');
    }

     /**
     * Maneja la descarga de un archivo.
     */
    public function download(Fichero $file)
    {
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
