<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UserRegistrationLog
{
    public function registerLog(User $user): void
    {
        $data = [
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'date_time' => Carbon::now()->format('Y-m-d H:i:s'),
        ];

        Log::info($data);
    }
}
