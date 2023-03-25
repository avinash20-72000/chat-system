<?php

namespace App\Policies;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChatPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Chat $chat)
    {
        return $user->hasPermission('Chat','view');
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Chat $chat)
    {
        //
    }

    public function delete(User $user, Chat $chat)
    {
        //
    }

    public function restore(User $user, Chat $chat)
    {
        //
    }

    public function forceDelete(User $user, Chat $chat)
    {
        //
    }
}
