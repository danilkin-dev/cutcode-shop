<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Support\SessionRegenerator;

class SignInController extends Controller
{
    public function page(): View
    {
        return view('auth.login');
    }

    public function handle(SignInFormRequest $request): RedirectResponse
    {
        if (!Auth::once($request->validated())) {
            return back()->withErrors([
                'email' => 'Неверный логин или пароль',
            ])->onlyInput('email');
        }

        SessionRegenerator::run(fn () => Auth::login(
            Auth::user()
        ));

        return redirect()->intended(route('home'));
    }

    public function logout(Request $request): RedirectResponse
    {
        SessionRegenerator::run(fn () => Auth::logout());

        return redirect()->route('home');
    }
}
