<?php

namespace App\Services\Auth;

use App\Events\Auth\UserRegistered;
use App\Models\User;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterService
{
  public function __construct(
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

      UserRegistered::dispatch($user);
  }
}
