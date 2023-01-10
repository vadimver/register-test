<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterService
{
    public function __construct(private UserRegistrationLog $logger)
    {
    }

    public function actions(User $user): void
    {
        event(new Registered($user));

        $this->logger->registerLog($user);
    }
}
