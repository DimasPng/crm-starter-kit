<?php

namespace App\Services\Auth;

use App\Events\Auth\UserRegistered;
use App\Mail\Auth\UserRegisteredMail;
use App\Models\User;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterService
{
  public function __construct(
    private Dispatcher $dispatcher,
  ) {
  }

  public function register(string $username, string $email, string $password)
  {
      $user = User::create([
        'name' => $username,
        'email' => $email,
        'password' => Hash::make($password),
        'confirm_token' => Str::random(32),
      ]);

      Mail::to($user->getEmail())->send(new UserRegisteredMail($user));

      //$this->dispatcher->dispatch(new UserRegistered($user));
  }
}
