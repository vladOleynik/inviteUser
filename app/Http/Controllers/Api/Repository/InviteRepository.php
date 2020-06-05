<?php


namespace App\Http\Controllers\Api\Repository;


use App\Models\Invite;
use Illuminate\Support\Facades\DB;

class InviteRepository
{
    const PENDING_INVITE = 'pending';
    const DECLINE_INVITE = 'decline';
    const ACCEPT_INVITE = 'accept';

    public function getInvite(int $inviteId): Invite
    {
        return Invite::find($inviteId);
    }
}
