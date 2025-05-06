<?php

namespace App\Services;

use App\Models\AccessToken;
use App\Models\User;

class AuthenticationService
{
    public static function login(string $email, string $password): void
    {
        $response = BackendHttpService::post('/login', [
            'email' => $email,
            'password' => $password,
            'device_name' => uniqid('android-', true),
        ], false);

        $token = $response->json('token');

        if (null === $token) {
            abort(401, 'Unauthorized');
        }

        AccessToken::create([
            'value' => $token,
        ]);

        if (self::isLoggedIn()) {
            redirect()->route('login');
        }

        redirect()->route('homepage');
    }

    public static function isLoggedIn(): bool
    {
        try {
            $check = BackendHttpService::get('/user');

            if (null !== $check->json()) {
                return true;
            }
        } catch (\Exception) {
        }

        return false;
    }

    public static function getActiveUser(): User
    {
        if (! self::isLoggedIn()) {
            redirect()->route('login');
        }

        return User::make(
            BackendHttpService::get('/user')->json()
        );
    }

    public static function logout(): void
    {
        $check = BackendHttpService::post('/logout');

        if (null === $check->json()) {
            redirect()->route('login');
        }

        abort(500, 'Unable to logout');
    }
}
