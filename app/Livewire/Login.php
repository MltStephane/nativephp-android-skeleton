<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;

class Login extends Component
{
    public function render(): View
    {
        return view('livewire.login');
    }
}
