<div>
    <div class="space-y-4">
        <flux:input
            label="{{ __('model.users.name') }}"
            type="text"
            wire:model="name"
            :value="old('name')"
            required
            autofocus
            autocomplete="name"
        />

        <flux:input
            label="{{ __('model.users.email') }}"
            type="email"
            wire:model="email"
            :value="old('email')" required
            autocomplete="email"
        />

        <flux:input
            label="{{ __('model.users.password') }}"
            type="password"
            wire:model="password"
            required
            autocomplete="new-password"
        />

        <flux:input
            label="{{ __('model.users.password_confirmation') }}"
            type="password"
            wire:model="password_confirmation"
            required
            autocomplete="new-password"
        />

        @if(\App\Services\WebRoutingService::has('terms.show') && \App\Services\WebRoutingService::has('policy.show'))
            <flux:field variant="inline">
                <flux:checkbox wire:model="terms" />

                <flux:label>
                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                    'terms_of_service' => '<a target="_blank" href="'.App\Services\WebRoutingService::get('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                    'privacy_policy' => '<a target="_blank" href="'.App\Services\WebRoutingService::get('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                    ]) !!}
                </flux:label>

                <flux:error name="terms" />

            </flux:field>
        @endif
        <div class="flex items-center justify-start gap-4">
            <flux:button wire:click="register" variant="primary">
                {{ __('Register') }}
            </flux:button>

            <flux:button
                variant="ghost"
                href="{{ route('login') }}"
            >
                {{ __('Already registered?') }}
            </flux:button>
        </div>

        @session('status')
        <flux:callout color="orange">
            <flux:callout.text>
                {{ $value }}
            </flux:callout.text>
        </flux:callout>
        @endsession
    </div>
</div>
