<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class VerificationController extends Controller
{
    public function __construct(protected User $user)
    {
    }

    public function verify(int $id): Response
    {
        $user = $this->user->find($id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            $message = __('messages.success');
        }

        return response([
            'message' => $message ?? __('messages.verified')
        ], Response::HTTP_OK);
    }
}
