<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasPermission('Role','viewAny');
    }

    public function view(User $user, Role $role)
    {
        return $user->hasPermission('Role','view');
    }

    public function create(User $user)
    {
        return $user->hasPermission('Role','create');
    }

    public function update(User $user, Role $role)
    {
        return $user->hasPermission('Role','update');
    }

    public function delete(User $user, Role $role)
    {
        return $user->hasPermission('Role','delete');
    }

    public function restore(User $user, Role $role)
    {
        //
    }

    public function forceDelete(User $user, Role $role)
    {
        //
    }
}
