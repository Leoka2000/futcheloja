<div>
    {{-- Success Message --}}
    @if (session()->has('success') && !session()->has('cart_message'))
    <x-mary-alert title="Cadastro de envio confirmado, prossiga ao pagamento à direita" class="alert-success"
        icon="o-check" shadow />
    @endif
    <style>
        /* Remove the default border and outline for all inputs */
        input,
        select {
            border: none !important;
            /* Ensure the border is transparent */
            outline: none !important;
            /* Remove the default outline */
        }

        div>.flex>.border-primary {
            border: none !important
        }

        /* Apply yellow outline only on focus */
        input:focus {
            outline: 2px solid oklch(var(--wa)) !important;
            /* Yellow outline */
            outline-offset: 2px !important;
            /* Add offset for better visibility */
            box-shadow: none !important;
            /* Remove any default box-shadow */
            border-color: transparent !important;
            /* Ensure no border is shown */
        }
    </style>
    @if (!session()->has('success'))
    <x-mary-form wire:submit.prevent="submit"
        class="p-5 bg-gray-100 border rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">

        @php
        $brazilStates = [
        [
        'id' => 1,
        'name' => 'Acre',
        'abbreviation' => 'AC'
        ],
        [
        'id' => 2,
        'name' => 'Alagoas',
        'abbreviation' => 'AL'
        ],
        [
        'id' => 3,
        'name' => 'Amapá',
        'abbreviation' => 'AP'
        ],
        [
        'id' => 4,
        'name' => 'Amazonas',
        'abbreviation' => 'AM'
        ],
        [
        'id' => 5,
        'name' => 'Bahia',
        'abbreviation' => 'BA'
        ],
        [
        'id' => 6,
        'name' => 'Ceará',
        'abbreviation' => 'CE'
        ],
        [
        'id' => 7,
        'name' => 'Distrito Federal',
        'abbreviation' => 'DF'
        ],
        [
        'id' => 8,
        'name' => 'Espírito Santo',
        'abbreviation' => 'ES'
        ],
        [
        'id' => 9,
        'name' => 'Goiás',
        'abbreviation' => 'GO'
        ],
        [
        'id' => 10,
        'name' => 'Maranhão',
        'abbreviation' => 'MA'
        ],
        [
        'id' => 11,
        'name' => 'Mato Grosso',
        'abbreviation' => 'MT'
        ],
        [
        'id' => 12,
        'name' => 'Mato Grosso do Sul',
        'abbreviation' => 'MS'
        ],
        [
        'id' => 13,
        'name' => 'Minas Gerais',
        'abbreviation' => 'MG'
        ],
        [
        'id' => 14,
        'name' => 'Pará',
        'abbreviation' => 'PA'
        ],
        [
        'id' => 15,
        'name' => 'Paraíba',
        'abbreviation' => 'PB'
        ],
        [
        'id' => 16,
        'name' => 'Paraná',
        'abbreviation' => 'PR'
        ],
        [
        'id' => 17,
        'name' => 'Pernambuco',
        'abbreviation' => 'PE'
        ],
        [
        'id' => 18,
        'name' => 'Piauí',
        'abbreviation' => 'PI'
        ],
        [
        'id' => 19,
        'name' => 'Rio de Janeiro',
        'abbreviation' => 'RJ'
        ],
        [
        'id' => 20,
        'name' => 'Rio Grande do Norte',
        'abbreviation' => 'RN'
        ],
        [
        'id' => 21,
        'name' => 'Rio Grande do Sul',
        'abbreviation' => 'RS'
        ],
        [
        'id' => 22,
        'name' => 'Rondônia',
        'abbreviation' => 'RO'
        ],
        [
        'id' => 23,
        'name' => 'Roraima',
        'abbreviation' => 'RR'
        ],
        [
        'id' => 24,
        'name' => 'Santa Catarina',
        'abbreviation' => 'SC'
        ],
        [
        'id' => 25,
        'name' => 'São Paulo',
        'abbreviation' => 'SP'
        ],
        [
        'id' => 26,
        'name' => 'Sergipe',
        'abbreviation' => 'SE'
        ],
        [
        'id' => 27,
        'name' => 'Tocantins',
        'abbreviation' => 'TO'
        ]
        ];
        @endphp
        <x-mary-errors />
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <!-- Full-width Email Row -->
            <div class="md:col-span-2">
                <p class="mb-5 text-lg font-bold text-gray-900 dark:text-gray-200">Registro do cliente e informações de
                    entrega que usaremos <br /> para lhe fazer contato e prover feedback da sua compra</p>
                <x-mary-input id="email" label="E-mail para contato" wire:model.debounce.500ms="email"
                    icon="o-envelope" />

            </div>

            <!-- First Name & Last Name Row -->
            <div>
                <x-mary-input id="first_name" label="Nome" wire:model.debounce.500ms="first_name" icon="o-user" />

            </div>
            <div>
                <x-mary-input id="last_name" label="Sobrenome" wire:model.debounce.500ms="last_name" icon="o-user" />

            </div>

            <!-- Address & City Row -->
            <div>
                <x-mary-input id="address" label="Endereço" wire:model.debounce.500ms="address" icon="o-map-pin" />

            </div>
            <div>
                <x-mary-input id="city" label="Cidade" wire:model.debounce.500ms="city" icon="o-map-pin" />

            </div>

            <!-- State & CEP Row -->
            <div>
                <x-mary-select label="Estados do Brasil" :options="$brazilStates" wire:model="selectedState" />

            </div>
            <div>
                <x-mary-input id="cep" label="CEP" wire:model.debounce.500ms="zipcode" icon="o-map-pin" />

            </div>

            <!-- Full-width Phone & Submit Button Row -->
            <div class="md:col-span-2">
                <x-mary-input id="phone" label="Telefone" wire:model.debounce.500ms="phone" prefix="+55" />

            </div>
            <div class="flex justify-end md:col-span-2">
                <x-mary-button label="Registrar cliente" class="mt-5 btn-warning" type="submit" spinner="submit" />
            </div>
        </div>
    </x-mary-form>
    @endif
</div>