<?php

namespace App\Policies;

use App\Models\Module;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModulePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasPermission('Module','viewAny');
    }

    public function view(User $user, Module $module)
    {
        return $user->hasPermission('Module','view');
    }

    public function create(User $user)
    {
        return $user->hasPermission('Module','create');
    }

    public function update(User $user, Module $module)
    {
        return $user->hasPermission('Module','update');
    }

    public function delete(User $user, Module $module)
    {
        return $user->hasPermission('Module','delete');
    }

    public function restore(User $user, Module $module)
    {
        //
    }

    public function forceDelete(User $user, Module $module)
    {
        //
    }
}
