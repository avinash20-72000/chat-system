<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasPermission('User','viewAny');
    }

    public function view(User $user, User $model)
    {
        return $user->hasPermission('User','view');
    }

    public function create(User $user)
    {
        return $user->hasPermission('User','create');
    }

    public function update(User $user, User $model)
    {
        return $user->hasPermission('User','update');
    }

    public function delete(User $user, User $model)
    {
        return $user->hasPermission('User','delete');
    }

    public function restore(User $user, User $model)
    {
        return $user->hasPermission('User','restore');
    }

    public function forceDelete(User $user, User $model)
    {
        return $user->hasPermission('User','forceDelete');
    }

    public function logView(User $user, User $model)
    {
        return $user->hasPermission('User','logView');
    }

    public function assignRole(User $user, User $model)
    {
        return $user->hasPermission('User','assignRole');
    }
}
