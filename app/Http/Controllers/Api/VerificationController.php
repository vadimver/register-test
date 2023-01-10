<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class VerificationController extends Controller
{
    public function __construct(protected User $user)
    {
    }

    public function verify(int $id): Response
    {
        $user = $this->user->find($id);

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            $message = __('messages.success');
        }

        return response([
            'message' => $message ?? __('messages.verified'),
        ], Response::HTTP_OK);
    }
}
