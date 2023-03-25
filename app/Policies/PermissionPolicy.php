<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasPermission('Permission','viewAny');
    }

    public function view(User $user, Permission $permission)
    {
        return $user->hasPermission('Permission','view');
    }

    public function create(User $user)
    {
        return $user->hasPermission('Permission','create');
    }

    public function update(User $user, Permission $permission)
    {
        return $user->hasPermission('Permission','update');
    }

    public function delete(User $user, Permission $permission)
    {
        return $user->hasPermission('Permission','delete');
    }

    public function restore(User $user, Permission $permission)
    {
        //
    }

    public function forceDelete(User $user, Permission $permission)
    {
        //
    }
}
