<?php

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class IdeaPolicy
{
    /**
     * Determine whether the user can view any models.
     */


    /**
     * Determine whether the user can view the model.
     */


    /**
     * Determine whether the user can create models.
     */
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Idea $idea): bool
    {
        return ($user->is_admin || $user->is($idea->user_id));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Idea $idea): bool
    {
        return ($user->is_admin || $user->is($idea->user_id));
    }

    /**
     * Determine whether the user can restore the model.
     */


    /**
     * Determine whether the user can permanently delete the model.
     */
}
