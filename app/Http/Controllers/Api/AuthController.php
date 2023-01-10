<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use App\Services\RegisterService;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(private User $user, private RegisterService $registerService)
    {
    }

    public function register(RegisterRequest $request): Response
    {
        $user = $this->user->create($request->validated());

        $this->registerService->actions($user);

        return response([
            'data' => new AuthResource($user),
        ], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request): Response
    {
        $successAttempt = auth()->attempt($request->validated());

        if (! $successAttempt) {
            return response([
                'message' => __('messages.unauthorized_login'),
                'errors' => __('messages.unauthorized'),
            ], Response::HTTP_FORBIDDEN);
        }

        return response([
            'data' => new AuthResource(auth()->user()),
        ], Response::HTTP_OK);
    }

    public function logout(): Response
    {
        auth()->user()->tokens()->where('id', auth()->id())->delete();

        return response([
            'message' => __('messages.logout'),
            'result' => __('messages.success'),
        ], Response::HTTP_OK);
    }
}
