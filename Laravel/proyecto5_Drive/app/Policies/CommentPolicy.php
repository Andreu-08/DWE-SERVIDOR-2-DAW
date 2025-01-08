<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    /**
     * Determina si el usuario puede responder al comentario.
     */
    public function reply(User $user, Comment $comment)
    {
        // Permitir solo al dueño del archivo responder al comentario
        return $user->id === $comment->file->user_id;
    }

    


    //polittica para que solo el autor pueda borrar comentarios 
    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }

}


