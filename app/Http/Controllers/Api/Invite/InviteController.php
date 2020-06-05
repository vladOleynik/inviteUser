<?php

namespace App\Http\Controllers\Api\Invite;

use App\Http\Controllers\Api\Service\InviteService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Invite\CreatorInviteRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 *
 * @authenticated
 * Bearer token
 * APIs for invite user
 * Class InviteController
 * @package App\Http\Controllers\Api\Invite
 */
class InviteController extends Controller
{
    /**
     * @var InviteService
     */
    private $service;

    public function __construct(InviteService $service)
    {
        $this->service = $service;
    }

    /**
     * @bodyParam recipient_id int required id user for invite
     * @param CreatorInviteRequest $request
     */
    public function createInvite(CreatorInviteRequest $request)
    {
        try {
            $this->service->createInvite($request->recipient_id, Auth::id());
        } catch (\Throwable $exception) {
            return response(['status' => 'error', 'message' => $exception->getMessage()], Response::HTTP_CONFLICT);
        }
        return response(['status' => 'success', 'message'=>'invite created'], Response::HTTP_OK);
    }

    public function getInvites()
    {

    }
}
