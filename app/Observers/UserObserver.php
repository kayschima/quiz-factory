<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\UserCreatedNotification;

class UserObserver
{
    public function created(User $user): void
    {
        $user->notify(new UserCreatedNotification);
    }
}
