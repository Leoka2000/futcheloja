<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Informações do Perfil') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Atualize as informações do perfil e o endereço de e-mail da sua conta.') }}
    </x-slot>

    <x-slot name="form">


        <!-- Nome -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Nome') }}" />
            <x-input id="name" type="text" class="block w-full mt-1" wire:model="state.name" required
                autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- E-mail -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('E-mail') }}" />
            <x-input id="email" type="email" class="block w-full mt-1" wire:model="state.email" required
                autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && !
            $this->user->hasVerifiedEmail())
            <p class="mt-2 text-sm dark:text-white">
                {{ __('Seu endereço de e-mail não foi verificado.') }}

                <button type="button"
                    class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 dark:focus:ring-offset-gray-800"
                    wire:click.prevent="sendEmailVerification">
                    {{ __('Clique aqui para reenviar o e-mail de verificação.') }}
                </button>
            </p>

            @if ($this->verificationLinkSent)
            <p class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                {{ __('Um novo link de verificação foi enviado para o seu endereço de e-mail.') }}
            </p>
            @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Salvo.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Salvar') }}
        </x-button>
    </x-slot>
</x-form-section>