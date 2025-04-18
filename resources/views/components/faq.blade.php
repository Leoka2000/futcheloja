<section
    class="relative isolate overflow-x-hidden py-16 bg-white dark:bg-inherit min-w-screen animation-fade animation-delay">
    <div class="absolute top-0 left-1/2 -z-10 -translate-x-1/2 blur-[5rem] xl:-top-6 opacity-70 animate-blur-move"
        aria-hidden="true">
        <div class="aspect-[1155/678] w-[72.1875rem] bg-gradient-to-tr from-[#facc15] to-[#4ade80]"
            style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
        </div>
    </div>

    <div class="container px-4 mx-auto sm:px-12 xl:px-5">
        <p class="text-xs font-bold text-left text-red-500 dark:text-red-400 uppercase sm:mx-6 sm:text-center sm:text-normal sm:font-bold"
            data-primary="red-500">
            Há perguntas? Temos as respostas 😉
        </p>
        <h3
            class="mt-1 text-2xl font-bold text-left text-gray-800 dark:text-gray-100 sm:mx-6 sm:text-3xl md:text-4xl lg:text-5xl sm:text-center sm:mx-0">
            Perguntas Frequentes (FAQ)
        </h3>

        <div x-data="{ activeAccordion: '', setActiveAccordion(id) { this.activeAccordion = (this.activeAccordion == id) ? '' : id } }"
            class="w-full mx-auto mt-10 overflow-hidden text-sm font-normal bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700 rounded-md sm:shadow ">

            <!-- Item 1 -->
            <div x-data="{ id: $id('accordion') }" class="cursor-pointer group px-6 py-6 sm:px-8 md:px-12 sm:py-8">
                <button @click="setActiveAccordion(id)"
                    class="flex items-center justify-between w-full text-left select-none">
                    <h3 class="text-lg font-bold text-yellow-500 dark:text-yellow-400 sm:text-xl md:text-2xl"
                        data-primary="yellow-500">
                        Como funciona o processo de compra?
                    </h3>
                    <svg class="w-4 h-4 duration-200 ease-out ml-4" :class="{ 'rotate-180': activeAccordion==id }"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9" />
                    </svg>
                </button>
                <div x-show="activeAccordion==id" x-collapse x-cloak>
                    <p class="mt-4 text-base text-gray-600 dark:text-gray-300 sm:text-lg md:text-normal">
                        Você escolhe os produtos desejados, adiciona ao carrinho e finaliza o pagamento. Enviaremos a
                        confirmação do pedido por e-mail e iniciaremos o envio imediatamente.
                    </p>
                </div>
            </div>

            <!-- Item 2 -->
            <div x-data="{ id: $id('accordion') }" class="cursor-pointer group px-6 py-6 sm:px-8 md:px-12 sm:py-8">
                <button @click="setActiveAccordion(id)"
                    class="flex items-center justify-between w-full text-left select-none">
                    <h3 class="text-lg font-bold text-yellow-500 dark:text-yellow-400 sm:text-xl md:text-2xl">
                        Quais são as formas de pagamento?
                    </h3>
                    <svg class="w-4 h-4 duration-200 ease-out ml-4" :class="{ 'rotate-180': activeAccordion==id }"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9" />
                    </svg>
                </button>
                <div x-show="activeAccordion==id" x-collapse x-cloak>
                    <p class="mt-4 text-base text-gray-600 dark:text-gray-300 sm:text-lg md:text-normal">
                        Aceitamos pagamentos via cartão de crédito, débito e pix.
                    </p>
                </div>
            </div>

            <!-- Item 3 -->
            <div x-data="{ id: $id('accordion') }" class="cursor-pointer group px-6 py-6 sm:px-8 md:px-12 sm:py-8">
                <button @click="setActiveAccordion(id)"
                    class="flex items-center justify-between w-full text-left select-none">
                    <h3 class="text-lg font-bold text-yellow-500 dark:text-yellow-400 sm:text-xl md:text-2xl">
                        Qual o prazo de entrega?
                    </h3>
                    <svg class="w-4 h-4 duration-200 ease-out ml-4" :class="{ 'rotate-180': activeAccordion==id }"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9" />
                    </svg>
                </button>
                <div x-show="activeAccordion==id" x-collapse x-cloak>
                    <p class="mt-4 text-base text-gray-600 dark:text-gray-300 sm:text-lg md:text-normal">
                        O prazo de entrega varia conforme a sua localização. Em média, entregamos entre 5 a 10 dias
                        úteis após a confirmação do pagamento.
                    </p>
                </div>
            </div>

            <!-- Item 4 -->
            <div x-data="{ id: $id('accordion') }" class="cursor-pointer group px-6 py-6 sm:px-8 md:px-12 sm:py-8">
                <button @click="setActiveAccordion(id)"
                    class="flex items-center justify-between w-full text-left select-none">
                    <h3 class="text-lg font-bold text-yellow-500 dark:text-yellow-400 sm:text-xl md:text-2xl">
                        Posso trocar ou devolver um produto?
                    </h3>
                    <svg class="w-4 h-4 duration-200 ease-out ml-4" :class="{ 'rotate-180': activeAccordion==id }"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9" />
                    </svg>
                </button>
                <div x-show="activeAccordion==id" x-collapse x-cloak>
                    <p class="mt-4 text-base text-gray-600 dark:text-gray-300 sm:text-lg md:text-normal">
                        Sim! Aceitamos trocas e devoluções dentro de 7 dias após o recebimento. Basta clicar no botão
                        "Reembolso" na seção "Minhas Compras".
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>
