<?php

namespace App\Http\Controllers\Api\Invite;

use App\Http\Controllers\Api\Service\InviteService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Invite\CreatorInviteRequest;
use App\Http\Requests\Api\Invite\GetterInviteRequest;
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
     * Create a user
     * [Endpoint for create invite]
     * @param CreatorInviteRequest $request
     */
    public function createInvite(CreatorInviteRequest $request)
    {
        try {
            $this->service->createInvite($request->recipient_id, Auth::id());
        } catch (\Throwable $exception) {
            return response(['status' => 'error', 'message' => $exception->getMessage()], Response::HTTP_CONFLICT);
        }
        return response(['status' => 'success', 'message' => 'invite created'], Response::HTTP_OK);
    }

    /**
     * @bodyParam status_invite string  value may be decline or accept default pending
     * [Endpoint for show list invite]
     * @param GetterInviteRequest $request
     * @return mixed
     */
    public function getInvitesForUser(GetterInviteRequest $request)
    {
        return \response($this->service->getInvites($request->status_invite));
    }

    public function getInvitesFromUser()
    {

    }
}
