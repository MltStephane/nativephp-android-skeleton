<?php

namespace App\Services;

use App\Models\AccessToken;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class BackendHttpService
{
    public static function post(string $endpoint, array $data = [], bool $shouldBeAuthenticated = true): Response
    {
        $url = str(config('app.backend_url'))->append($endpoint)->replace('//', '/')->toString();

        if ($shouldBeAuthenticated) {
            $accessToken = AccessToken::latest()->first();

            if (null === $accessToken) {
                abort(401, 'Utilisateur non authentifié. Veuillez vous connecter pour accéder à cette ressource.');
            }

            return Http::withToken($accessToken->value)->post($url, $data);
        }

        return Http::post($url, $data);
    }

    public static function get(string $endpoint, array $query = [], bool $shouldBeAuthenticated = true): Response
    {
        $url = str(config('app.backend_url'))->append($endpoint)->replace('//', '/')->toString();

        if ($shouldBeAuthenticated) {
            $accessToken = AccessToken::latest()->first();

            if (null === $accessToken) {
                abort(401, 'Utilisateur non authentifié. Veuillez vous connecter pour accéder à cette ressource.');
            }

            return Http::withToken($accessToken->value)->get($url, $query);
        }

        return Http::get($url, $query);
    }
}
