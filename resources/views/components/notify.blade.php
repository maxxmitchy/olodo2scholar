<div
    x-data="{
        show: false,
        messages: [],
        remove(message) {
            this.messages.splice(this.messages.indexOf(message), 1)
        }
    }"
    @notify.window="show = true; let message = $event.detail; messages.push(message); setTimeout(() => { remove(message), show = false }, 1500)"
    class="fixed inset-0 flex flex-col items-end justify-center px-4 py-6 space-y-4 sm:p-6 sm:justify-start"
    x-show = show
    style="display: none;"
>
    <div @click="show=false" class="fixed inset-0 z-50 bg-gray-800 opacity-60"></div>
    <template x-for="(message, messageIndex) in messages" :key="messageIndex">
        <div
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="ease-in duration-100 transition"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="z-50 w-full max-w-sm bg-white rounded shadow-lg pointer-event-visible"
            >
            <div class="overflow-hidden rounded shadow-xs">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1 w-0 pt-0 ml-3 5">
                            <p x-text="message" class="text-sm font-medium leading-5 text-gray-900"></p>
                        </div>
                        <div class="flex flex-shrink-0 ml-4">
                            <button class="inline-flex text-gray-400 transition duration-150 ease-in-out focus:outline-none focus:text-gray-500">
                                <svg @click="messages.splice(messageIndex, 1)" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
