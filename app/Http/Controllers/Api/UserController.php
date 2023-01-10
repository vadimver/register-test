<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(protected User $user)
    {
    }

    public function index(): UserCollection
    {
        return new UserCollection($this->user->all());
    }

    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    public function update(UpdateRequest $request, User $user): UserResource
    {
        $user->update($request->validated());

        return new UserResource($user);
    }

    public function destroy(User $user): Response
    {
        $user->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }

    protected function userResponse(User $user): UserResource
    {
        return new UserResource($user);
    }
}
