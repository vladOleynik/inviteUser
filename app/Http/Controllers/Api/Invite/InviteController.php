<?php

namespace App\Http\Controllers\Api\Invite;

use App\Http\Controllers\Api\Repository\InviteRepository;
use App\Http\Controllers\Api\Service\InviteService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Invite\CreatorInviteRequest;
use App\Http\Requests\Api\Invite\GetterInviteRequest;
use App\Http\Requests\Api\Invite\SetterStatusInvite;
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
    /**
     * @var InviteRepository
     */
    private $repository;

    public function __construct(InviteService $service, InviteRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
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
        try {
            $invite = $this->service->getInvites($request->status_invite);
        } catch (\Throwable $exception) {
            return response(['status' => 'error', 'message' => $exception->getMessage()]);
        }
        return response(['status' => 'success', 'data' => $invite]);
    }

    /**
     * @bodyParam id_invite integer required  id invite
     * @bodyParam status string required  value may be accept or decline
     * @param SetterStatusInvite $request
     */
    public function setStatusInvite(SetterStatusInvite $request)
    {
        try {
            $invite = $this->repository->getInvite($request->id_invite);
            $this->service->setStatusInvite($invite, $request->id_invite);
        } catch (\Throwable $exception) {
            return response(['status' => 'error', 'message' => $exception->getMessage()]);
        }
        return response(['status' => 'success', 'message' => 'invite has updated']);
    }
}
