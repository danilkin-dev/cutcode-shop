<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Domain\Auth\Models\User;
use DomainException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialAuthController extends Controller
{
    public function redirect(string $driver): RedirectResponse
    {
        try {
            return Socialite::driver($driver)
            ->redirect();
        } catch (Throwable $e) {
            throw new DomainException('Произошла ошибка или драйвер не поддерживается');
        }
    }

    public function callback(string $driver): RedirectResponse
    {
        if ($driver !== 'github') {
            throw new DomainException('Драйвер не поддерживается');
        }

        $user = Socialite::driver($driver)->user();

        $user = User::updateOrCreate([
            $driver . '_id' => $user->id,
        ], [
            'name' => $user->name ?? $user->email,
            'email' => $user->email,
            'password' => bcrypt(str()->random(20)),
        ]);

        Auth::login($user);

        return redirect()
            ->intended(route('home'));
    }
}
