<?php

namespace App\Livewire\Authenticated;

use Illuminate\Contracts\View\View;

class Dashboard extends AuthenticatedComponent
{
    public function render(): View
    {
        return view('livewire.authenticated.dashboard');
    }
}
