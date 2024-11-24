<?php

namespace App\Policies;

use App\Models\Fichero;
use App\Models\User;

class FicheroPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // permite subir ficheros a cualquier usuario
    public function upload(User $user)
    {
        return true;
    }

    //permite eliminar el fichero solo al ususario que ha subido el fichero
    public function delete(User $user , Fichero $fichero)
    {
        return $user->id === $fichero->user_id;
    }

    //permite ver el fichero si es publico o si el usuario es el propietario
    public function view(User $user, Fichero $fichero)
    {
        return $fichero->visibility === 'public' || $user->id === $fichero->user_id;
    }

    //permite comentar si el fichero es publico y no es del usuario autenticado
    public function comment(User $user, Fichero $file)
    {
        // Permitir comentarios si el archivo es público y no pertenece al usuario autenticado
        if ($file->visibility === 'public' && $user->id !== $file->user_id) {
            return true;
        }

        // Si el archivo es privado, denegar comentarios a otros usuarios
        if ($file->visibility === 'private') {
            return false;
        }

        // Permitir al propietario responder solo si ya hay comentarios en su archivo
        if ($user->id === $file->user_id) {
            return $file->comments()->exists();
        }

        return false; // Caso contrario, denegar
    }

    
    
}
