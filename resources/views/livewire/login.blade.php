<div>
    <div class="space-y-4">
        <flux:input
            label="{{ __('model.users.email') }}"
            type="email"
            wire:model="email"
            :value="old('email')"
            required
            autofocus
            autocomplete="username"
        />

        <flux:input
            label="{{ __('model.users.password') }}"
            type="password"
            wire:model="password"
            required
            autocomplete="current-password"
            viewable
        />

        <div class="grid grid-cols-2 gap-4">
            <flux:button wire:click="login" class="w-full">
                {{ __('Log in') }}
            </flux:button>
            <flux:button
                variant="ghost"
                {{--                        href="{{ route('password.request') }}"--}}
            >
                {{ __('Forgot your password?') }}
            </flux:button>
        </div>

        @session('status')
        <flux:callout color="orange">
            <flux:callout.text>
                {{ $value }}
            </flux:callout.text>
        </flux:callout>
        @endsession

        <flux:separator />

        <div>
            <flux:text>
                {{ __('auth.login.register_intro') }}
                <flux:link
                    href="{{ route('register') }}"
                >
                    {{ __('auth.login.register_action') }}
                </flux:link>
            </flux:text>
        </div>
    </div>
</div>
