<?php

namespace App\Livewire\Authenticated;

use App\Models\User;
use App\Services\AuthenticationService;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AuthenticatedComponent extends Component
{
    public function user(): User
    {
        return AuthenticationService::getActiveUser();
    }
}
