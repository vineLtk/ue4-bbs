<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * currentUser当前登录对象
     * user即将操作对象
     */
    public function update(User $currentUser, User $user){
        return $user->id === $currentUser->id;
    }
}
