<div class="space-y-6">
    @if(null !== $error)
        <flux:callout color="red">
            <flux:callout.text>
                {{ $error }}
            </flux:callout.text>
        </flux:callout>
    @endif

    <flux:card class="w-full space-y-6">
        <flux:input
            label="Adresse email"
            wire:model="email"
            required
        />
        <flux:input
            label="Mot de passe"
            type="password"
            wire:model="password"
            viewable
            required
        />

        <flux:button wire:click="login">
            Connexion
        </flux:button>
    </flux:card>
</div>
