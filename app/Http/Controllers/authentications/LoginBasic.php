<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-login-basic', ['pageConfigs' => $pageConfigs]);
  }

  public function login(AuthLoginRequest $request)
  {
    $auth = Auth::attempt(
      $request->only($this->username($request), 'password'),
      $request->filled('remember-me')
    );

    if ($auth) {
      $request->session()->regenerate();
      /** @var User $user */
      $user = Auth::user();
      if (!$user->isConformed()) {
        Auth::logout();
        return redirect()->back()->with('error', 'You need confirm your account. Check your email.');
      }

      return redirect()->route('pages-home');
    }

    return redirect()->back()->with('error', 'login or password are invalid');
  }

  public function username(AuthLoginRequest $request): string
  {
    $field = (filter_var($request->get('email-username'), FILTER_VALIDATE_EMAIL)) ? 'email' : 'name';
    $request->merge([$field => request()->get('email-username')]);
    return $field;
  }
}
