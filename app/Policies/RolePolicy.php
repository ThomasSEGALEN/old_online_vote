<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
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
        foreach ($user->roles as $role) {
            return $role->permissions->contains('id', Permission::ROLES_VIEW_ANY);
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Role $model)
    {
        foreach ($user->roles as $role) {
            return $role->permissions->contains('id', Permission::ROLES_VIEW);
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        foreach ($user->roles as $role) {
            return $role->permissions->contains('id', Permission::ROLES_CREATE);
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Role $model)
    {
        foreach ($user->roles as $role) {
            return $role->permissions->contains('id', Permission::ROLES_UPDATE);
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Role $model)
    {
        foreach ($user->roles as $role) {
            return $role->permissions->contains('id', Permission::ROLES_DELETE);
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Role $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Role $model)
    {
        //
    }
}
