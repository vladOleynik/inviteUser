<?php

namespace App\Models;

use App\Http\Controllers\Api\Repository\InviteRepository;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invite extends Pivot
{
    use SoftDeletes;

    protected $table = "invites";
    protected $guarded = ['id'];

    public function scopePendingInvites($query)
    {
        return $query->where('status_invite', InviteRepository::PENDING_INVITE);
    }

    public function scopeAcceptInvites($query)
    {
        return $query->where('status_invite', InviteRepository::ACCEPT_INVITE);
    }

    public function scopeDeclineInvites($query)
    {
        return $query->where('status_invite', InviteRepository::DECLINE_INVITE);
    }
}
