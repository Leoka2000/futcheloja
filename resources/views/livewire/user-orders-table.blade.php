<div class="items-center px-2 mx-auto max-w-7xl xl:px-5">
    <a href="{{ route('livewire.components.hero') }}" x-data="{ loading: false }"
        @click.prevent="loading = true; setTimeout(() => window.location.href = $el.href, 200)">
        <x-mary-button icon="o-arrow-uturn-left" class="w-full mb-10 btn md:w-96"> Voltar </x-mary-button>
    </a>

    <h1 class="mb-10 text-xl md:text-2xl"><strong>Minhas compras</strong></h1>

    @if(auth()->check() && $orders->isNotEmpty())
    <x-mary-table :headers="$headers" :rows="$orders">
        @scope('cell_name', $order)
        <span>{{ $order->name }}</span>
        @endscope

        @scope('cell_size', $order)
        <span>{{ $order->size }}</span>
        @endscope

        @scope('cell_quantity', $order)
        <span>{{ $order->quantity }}</span>
        @endscope

        @scope('cell_unit_price', $order)
        <span>${{ $order->unit_price }}</span>
        @endscope

        @scope('cell_status', $order)
        @if ($order->status === 'under_process')
        <span
            class="inline-flex items-center px-2 py-1 text-xs font-medium text-yellow-800 rounded-md bg-yellow-50 ring-1 ring-yellow-600/20 ring-inset dark:bg-yellow-900 dark:text-yellow-300">
            Processando pagamento... ⏰
        </span>
        @elseif ($order->status === 'paid')
        <span
            class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 rounded-md bg-green-50 dark:bg-green-200 ring-1 ring-green-600/20 ring-inset">
            Pago com sucesso ✅
        </span>
        @else
        <span
            class="inline-flex items-center px-2 py-1 text-xs font-medium text-yellow-800 rounded-md bg-yellow-50 ring-1 ring-yellow-600/20 ring-inset dark:bg-yellow-900 dark:text-yellow-300">
            {{ $order->status }}
        </span>
        @endif
        @endscope

        @scope('actions', $order)
        <x-mary-button wire:click="openModal" class="my-2" label="Reembolso" spinner />
        @endscope
    </x-mary-table>
    @else
    <div
        class="flex flex-col items-center gap-1 p-4 border border-gray-100 rounded-lg shadow-lg dark:border-gray-800 md:p-6">
        <x-mary-icon name="o-x-mark"
            class="w-12 h-12 p-2 text-gray-400 bg-gray-200 rounded-full shadow dark:bg-gray-700 darktext-gray-500" />
        <p class="text-center text-gray-900 dark:text-white">Não há compras </p>
        <a href="{{ route('components.shopping_cart_component_index') }}" x-data="{ loading: false }"
            @click.prevent="loading = true; setTimeout(() => window.location.href = $el.href, 250)">
            <template x-if="!loading">
                <x-mary-button spinner class="w-full mt-2 btn-warning" icon="o-shopping-cart">
                    Realize sua primeira compra
                </x-mary-button>
            </template>
            <template x-if="loading">
                <x-mary-button class="w-full mt-2 btn-warning">
                    <x-mary-loading class="w-6 text-gray-800" />
                </x-mary-button>
            </template>
        </a>
    </div>
    @endif

    @if($showModal)
    <div id="crud-modal" class="fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-opacity-50">
        <x-mary-form wire:submit.prevent="submit"
            class="relative w-full max-w-md p-4 bg-white rounded-lg shadow-lg dark:bg-gray-800">
            <x-mary-errors />
            <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pedido de reembolso</h3>
                <x-mary-button wire:click="closeModal" icon="o-x-mark" class="btn-circle btn-sm" />
            </div>
            <div class="p-4">
                <div class="">
                    <div class="mb-3">
                        <label for="order_hashed_id"
                            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Id do pedido</label>
                        <x-mary-input type="text" id="order_hashed_id" wire:model.defer="order_hashed_id"
                            class="w-full p-2 border border-gray-300 rounded-lg dark:border-gray-500 dark:bg-gray-600 dark:text-white"
                            placeholder="Digite seu ID do pedido" />
                    </div>
                    <div class="mb-3">
                        <label for="refund_pix_key"
                            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Chave PIX para
                            reembolso</label>
                        <x-mary-input type="text" id="refund_pix_key" wire:model.defer="refund_pix_key"
                            class="w-full p-2 border border-gray-300 rounded-lg dark:border-gray-500 dark:bg-gray-600 dark:text-white"
                            placeholder="Digite sua chave PIX" />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Seu
                            e-mail</label>
                        <x-mary-input type="email" id="email" wire:model.defer="email"
                            class="w-full p-2 border border-gray-300 rounded-lg dark:border-gray-500 dark:bg-gray-600 dark:text-white"
                            placeholder="Digite seu e-mail" />
                    </div>
                    <div class="mb-3">
                        <label for="refund_reason"
                            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Motivo do
                            reembolso</label>
                        <x-mary-input type="text" id="refund_reason" wire:model.defer="refund_reason"
                            class="w-full p-2 border border-gray-300 rounded-lg dark:border-gray-500 dark:bg-gray-600 dark:text-white"
                            placeholder="Explique seu motivo" />
                    </div>
                </div>
                <x-mary-button label="Enviar pedido" type="submit" spinner="submit" class="w-full py-2"
                    icon="o-paper-airplane" />
            </div>
        </x-mary-form>
    </div>
    @endif
</div>