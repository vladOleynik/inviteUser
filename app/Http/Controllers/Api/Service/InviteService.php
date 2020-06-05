<?php


namespace App\Http\Controllers\Api\Service;


use App\Models\Invite;
use Illuminate\Support\Facades\DB;

class InviteService
{
    public function createInvite(int $idRecipient, int $idInitiatorInvite): void
    {
        DB::transaction(function () use ($idRecipient, $idInitiatorInvite) {
            Invite::create([
                'initiator_invite' => $idInitiatorInvite,
                'recipient_invite' => $idRecipient
            ]);
        });
    }
}
