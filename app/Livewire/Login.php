<?php

namespace App\Livewire;

use App\Services\AuthenticationService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Login extends Component
{
    public ?string $email = null;

    public ?string $password = null;

    public ?string $error = null;

    public function render(): View
    {
        return view('livewire.login');
    }

    public function login()
    {
        Validator::make([
            'email' => $this->email,
            'password' => $this->password,
        ], [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        try {
            AuthenticationService::login($this->email, $this->password);
        } catch (\Throwable $exception) {
            $this->error = ' Ces identifiants ne correspondent pas à nos enregistrements.';
        }
    }
}
