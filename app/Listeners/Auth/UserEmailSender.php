<?php

namespace App\Listeners\Auth;

use App\Events\Auth\UserRegistered;
use App\Mail\Auth\UserRegisteredMail;
use Illuminate\Support\Facades\Mail;

class UserEmailSender
{
    public function __construct()
    {
        //
    }


    public function handle(UserRegistered $event): void
    {

       Mail::to($event->user->getEmail())->send(new UserRegisteredMail($event->user));
    }
}
