<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function accessAdminPanel(User $user)
    {
        // Comprueba si el usuario tiene rol de administrador
        return $user->isAdmin();
    }

    
}
