<?php

namespace App\Services;

class WebRoutingService
{
    public static function get(string $routeName): string
    {
        return BackendHttpService::get("/routes/{$routeName}")->json();
    }

    public static function has(string $routeName): bool
    {
        return 'Route not found' !== self::get($routeName);
    }
}
