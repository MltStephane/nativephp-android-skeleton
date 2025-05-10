<?php

namespace App\Services;

class AccessTokenService
{

    public static function store(string $token): void
    {
        session()->put('access_token', $token);
    }

    public static function hasAccessToken(): bool
    {
        return session()->has('access_token');
    }

    public static function get(): ?string
    {
        if (! self::hasAccessToken()) {
            return null;
        }

        return session('access_token');
    }
}
