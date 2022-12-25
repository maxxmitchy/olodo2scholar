<div x-cloak x-data="{ active: {{ $comment['id'] }} }" class="space-y-8">
    <div x-data="{
        id: {{ $comment['id'] }},
        get expanded() {
            return this.active === this.id
        },
        set expanded(value) {
            this.active = value ? this.id : null
        },
    }" role="region"
        class="mb-4 border rounded"
        :class="{ 'border-gray-400' : expanded, 'border-gray-200' : !expanded }"
    >
        <h2>
            <button
                @click="expanded = !expanded"
                :aria-expanded="expanded"
                class="flex items-center justify-between w-full px-4 py-2 text-base rounded"
            >
                <p class="font-semibold tracking-wider text-left lg:text-base">{{ $comment['title'] }}</p>
                <span x-show="!expanded" aria-hidden="true" class="ml-4 text-xl font-bold">&minus;</span>
                <span x-show="expanded" aria-hidden="true" class="ml-4 text-xl font-bold">&plus;</span>
            </button>
        </h2>

        <div class="mt-4" x-show.transition="!expanded" x-collapse>
            <div class="px-4 pb-4 text-sm lg:text-base">
                {{ $body }}
            </div>
        </div>
    </div>
</div>
