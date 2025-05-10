<?php

namespace App\Livewire;

use App\Services\AuthenticationService;
use App\Services\WebRoutingService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Throwable;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public ?string $name = 'stephane@mulot.devaaa';
    public ?string $email = 'stephane@mulot.devaaa';
    public ?string $password = 'stephane@mulot.devaaa';
    public ?string $password_confirmation = 'stephane@mulot.devaaa';
    public bool $terms = false;

    public function render(): View
    {
        return view('livewire.register');
    }

    public function register(): void
    {
        $errors = [];

        if (! WebRoutingService::has('terms.show') && ! WebRoutingService::has('policy.show')) {
            $this->terms = true;
        }

        try {
            $errors = AuthenticationService::register($this->name, $this->email, $this->password, $this->password_confirmation);
        } catch (Throwable) {

        }

        if (0 !== count($errors)) {
            foreach ($errors as $errorName => $errorMessage) {
                $this->addError($errorName, $errorMessage);
            }
        }
    }
}
