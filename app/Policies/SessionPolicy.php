<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\Session;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SessionPolicy
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
        return $user->permissions->contains('id', Permission::SESSIONS_VIEW_ANY);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Session $session)
    {
        if ($user->sessions->contains('id', $session->id)) return true;

        return $user->permissions->contains('id', Permission::SESSIONS_VIEW);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->permissions->contains('id', Permission::SESSIONS_CREATE);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Session $session)
    {
        return $user->permissions->contains('id', Permission::SESSIONS_UPDATE);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Session $session)
    {
        return $user->permissions->contains('id', Permission::SESSIONS_DELETE);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Session $session)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Session $session)
    {
        //
    }
}
