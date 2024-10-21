<?php

namespace App\Listeners;

use App\Notifications\SendVerifyCode;
use App\Service\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserSignUpEventListener implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $userService = new UserService();
        $code = $userService->createVerifyCode($event->user->id);

        $event->user->notify(new SendVerifyCode($code));
    }
}
