<?php

namespace App\Policies;

use App\Models\Invite;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvitePolicy
{
    use HandlesAuthorization;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new policy instance.
     *
     * @param User $user
     */
    public function __construct()
    {

    }

    public function update(User $user, Invite $invite)
    {
        return $invite->recipient_invite === $user->id;
    }

}
