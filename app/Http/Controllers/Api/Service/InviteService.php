<?php


namespace App\Http\Controllers\Api\Service;


use App\Http\Controllers\Api\Repository\InviteRepository;
use App\Models\Invite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InviteService
{
    public function createInvite(int $idRecipient, int $idInitiatorInvite): void
    {
        $arrayInvite = [
            'initiator_invite' => $idInitiatorInvite,
            'recipient_invite' => $idRecipient
        ];
        DB::transaction(function () use ($arrayInvite) {
            Invite::firstOrCreate(
                $arrayInvite,
                $arrayInvite
            );
        });
    }

    public function getInvites($statusInvite)
    {
        $user = Auth::user();
        if ($statusInvite==InviteRepository::ACCEPT_INVITE) {
            return $user->invites()->acceptInvites()->get();
        }
        if ($statusInvite==InviteRepository::DECLINE_INVITE) {
            return $user->invites()->declineInvites()->get();
        }

        return $user->invites()->pendingInvites()->get();
    }
}
