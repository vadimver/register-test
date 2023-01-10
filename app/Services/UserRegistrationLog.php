<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class UserRegistrationLog
{
    public function __invoke(string $message) {
        Log::info($message);
    }
}
