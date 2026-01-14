<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Perfil') }}
        </h2>
    </x-slot>


    <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex flex-col">
            <a href="{{ route('livewire.components.hero') }}" x-data="{ loading: false }"
                @click.prevent="loading = true; setTimeout(() => window.location.href = $el.href, 100)">
                <x-mary-button icon="o-arrow-uturn-left" class="w-full mb-2 btn md:w-96"> Voltar </x-mary-button>
            </a>
            @if($user = auth()->user())
            <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="pt-2">
                <x-slot:actions>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-mary-button label="Logoff" icon="o-power" class="w-full mb-2 btn md:w-96"
                            tooltip-left="logoff" type="submit" />
                    </form>
                </x-slot:actions>
            </x-mary-list-item>
            @endif
        </div>
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
        @livewire('profile.update-profile-information-form')

        <x-section-border />
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        <div class="mt-10 sm:mt-0">
            @livewire('profile.update-password-form')
        </div>

        <x-section-border />
        @endif

        <div class="mt-10 sm:mt-0">
            @livewire('profile.logout-other-browser-sessions-form')
        </div>
    </div>
</x-app-layout>