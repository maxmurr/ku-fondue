<?php

namespace App\Policies;

use App\Models\Problem;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProblemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Problem  $problem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Problem $problem)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return !($user === null);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Problem  $problem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Problem $problem)
    {
        return $user->isUser() AND $problem->owner_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Problem  $problem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Problem $problem)
    {
        return ($user->isUser() AND $problem->owner_id === $user->id) OR $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Problem  $problem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Problem $problem)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Problem  $problem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Problem $problem)
    {
        //
    }

    public function changeStatus(User $user, Problem $problem){
        return $user->isEmployee() AND $user->department_id === $problem->department_id;
    }
}
