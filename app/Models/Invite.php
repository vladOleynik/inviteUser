<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invite extends Pivot
{
    protected $table = "invites";
    protected $guarded = ['id'];
    use SoftDeletes;
}
