<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    //verifica si el usuario es administrador o no
   public function before(User $user){

        return $user->isAdmin();
   }
}
