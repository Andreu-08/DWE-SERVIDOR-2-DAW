<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Fichero;
use App\Models\User;
use App\Models\UserAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Pagination\LengthAwarePaginator;

class FicheroController extends Controller
{
    use AuthorizesRequests;

    /**
     * Maneja la subida de un archivo.
     */
    public function upload(Request $request)
    {
       
        $request->validate([
            'uploaded_file' => 'required|file|max:10240', // 10MB
            'visibility' => 'required|in:public,private',
        ]);

        $fichero = new Fichero();
        $fichero->path = $request->file('uploaded_file')->store('uploads', 'private');
        $fichero->name = $request->file('uploaded_file')->getClientOriginalName();
        $fichero->visibility = $request->visibility;
        $fichero->user_id = Auth::id();

        $fichero->save();

        UserAction::create([
            'user_id' => Auth::id(),
            'action' => 'upload',
            'file_id' => $fichero->id,
        ]);

        return redirect()->back()->with('success', 'Archivo subido correctamente');
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

        return view('file_preview', compact('file', 'comments', 'fileSize'));
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
        $this->authorize('delete', $file);
        $file->delete();

        UserAction::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'file_id' => $file->id,
        ]);

        return redirect()->back()->with('success', 'Fichero movido a la papelera correctamente');
    }

    /**
     * Sirve el contenido de un archivo para previsualización.
     */
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

    public function index()
    {
        $ficherosPrivados = new LengthAwarePaginator([], 0, 10);
        $ficherosPublicos = Fichero::with('user')->where('visibility', 'public')->paginate(10);
        $ficherosTodos = new LengthAwarePaginator([], 0, 10);
        $ficherosCompartidos = new LengthAwarePaginator([], 0, 10);

        if (Auth::check()) {
            $ficherosPrivados = Fichero::with('user')->where('visibility', 'private')->where('user_id', Auth::id())->paginate(10);
            $ficherosTodos = Fichero::with('user')->where(function ($query) {
                $query->where('visibility', 'private')->where('user_id', Auth::id())
                      ->orWhere('visibility', 'public');
            })->paginate(10);
            $ficherosCompartidos = Auth::user()->sharedFiles()->with('user')->paginate(10);
        }

        return view('welcome', compact('ficherosPrivados', 'ficherosPublicos', 'ficherosTodos', 'ficherosCompartidos'));
    }

    public function trash()
    {
        $ficheros = Fichero::onlyTrashed()->where('user_id', Auth::id())->paginate(10);

        return view('partials.archivosEliminados', compact('ficheros'));
    }

    public function restore($id)
    {
        $file = Fichero::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $file);
        $file->restore();

        return redirect()->back()->with('success', 'Fichero recuperado correctamente');
    }

    /**
     * Maneja el compartir un archivo con otro usuario.
     */
    public function share(Request $request, $fileId)
    {
        $file = Fichero::findOrFail($fileId);
        $this->authorize('share', $file);

        $user = User::where('email', $request->input('email'))->firstOrFail();
        $file->sharedWith()->attach($user);

        UserAction::create([
            'user_id' => Auth::id(),
            'action' => 'share',
            'file_id' => $file->id,
        ]);

        return redirect()->back()->with('success', 'Fichero compartido correctamente');
    }

    /**
     * Muestra los archivos compartidos con el usuario autenticado.
     */
    public function sharedWithMe()
    {
        $ficheros = Auth::user()->sharedFiles()->with('user')->paginate(10);

        return view('archivosCompartidos', compact('ficheros'));
    }
}
