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

    // solo el ususario 1 puede subir archivos
    public function upload(User $user)
    {
        return true;
    }

    //solo el usuario que ha subido el fichero lo puedo borrar
    public function delete(User $user , Fichero $fichero)
    {
        return $user->id === $fichero->user_id;
    }
    
}
