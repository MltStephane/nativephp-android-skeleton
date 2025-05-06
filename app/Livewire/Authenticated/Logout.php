<?php

namespace App\Livewire\Authenticated;

use App\Services\AuthenticationService;

class Logout extends AuthenticatedComponent
{
    public function mount(): void
    {
        AuthenticationService::logout();

        redirect()->route('login');
}
}
