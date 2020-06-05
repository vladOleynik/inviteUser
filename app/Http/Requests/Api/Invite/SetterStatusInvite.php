<?php

namespace App\Http\Requests\Api\Invite;

use Illuminate\Foundation\Http\FormRequest;

class SetterStatusInvite extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_invite' => 'required|integer|exists:invites,id',
            'status_invite'=>'required|in:decline,accept'
        ];
    }
}
