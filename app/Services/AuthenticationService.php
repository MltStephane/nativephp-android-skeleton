<?php

namespace App\Services;

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

        AccessTokenService::store($token);

        if (self::isLoggedIn()) {
            redirect()->route('homepage');
        }

        redirect()->route('login');
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

        if ($check->json()) {
            redirect()->route('login');
        } else {
            abort(500, 'Unable to logout');
        }
    }

    public static function register(string $name, string $email, string $password, string $passwordConfirmation): ?array
    {
        $response = BackendHttpService::post('/register', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $passwordConfirmation,
        ], false);

        if (array_key_exists('errors', $response->json())) {
            return json_decode($response->json('errors'), true);
        }

        $token = $response->json('token');

        if (null === $token) {
            abort(401, 'Unauthorized');
        }

        AccessTokenService::store($token);

        if (self::isLoggedIn()) {
            redirect()->route('homepage');
        }

        redirect()->route('login');

        return null;
    }
}
