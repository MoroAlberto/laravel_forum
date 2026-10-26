<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // only admins can create new users
        return $user->is_admin;
    }
}
