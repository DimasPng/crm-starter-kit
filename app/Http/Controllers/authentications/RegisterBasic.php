<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\Auth\RegisterService;

class RegisterBasic extends Controller
{
  public function __construct(
    private RegisterService $registerService,
  ) {
  }

  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-register-basic', ['pageConfigs' => $pageConfigs]);
  }

  public function register(RegisterRequest $request)
  {
    $this->registerService->register(
      $request->get('username'),
      $request->get('email'),
      $request->get('password'),
    );

    return redirect()->route('auth-login-basic')->with('success', 'You are registered. Check your email');
  }


  public function confirm(string $token)
  {
    try {
      /** @var null|User $user */
      if(null !== $user = User::where('confirm_token', $token)->first()) {
        $user->verify();
        $user->save();
        return redirect()->route('pages-home')->with('success', 'Welcome! You are confirmed success.');
      }
    }catch (\DomainException $exception) {
      return redirect()->route('pages-home')->with('error', $exception->getMessage());
    }

    return redirect()->route('pages-home')->with('error', 'User not found');
  }
}
