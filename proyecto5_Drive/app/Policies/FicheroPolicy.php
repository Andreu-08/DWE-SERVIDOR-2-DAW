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
    
    
}
