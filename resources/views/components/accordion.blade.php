<div x-cloak x-data="{ active: {{ $comment['id'] }} }" class="space-y-4">
    <div x-data="{
        id: {{ $comment['id'] }},
        get expanded() {
            return this.active === this.id
        },
        set expanded(value) {
            this.active = value ? this.id : null
        },
    }" role="region"
        class="border mb-2 rounded"
        :class="{ 'border-gray-400' : expanded, 'border-green-600-600' : !expanded }"
    >
        <h2>
            <button
                @click="expanded = !expanded"
                :aria-expanded="expanded"
                class="rounded flex text-base items-center justify-between w-full px-4 py-2"
            >
                <p class="text-left text-sm sm:text-base font-bold tracking-wider">{{ $comment['title'] }}</p>
                <span x-show="!expanded" aria-hidden="true" class="ml-4 text-xl font-bold">&minus;</span>
                <span x-show="expanded" aria-hidden="true" class="ml-4 text-xl font-bold">&plus;</span>
            </button>
        </h2>

        <div x-show.transition="!expanded" x-collapse>
            <div class="pb-4 px-4">
                <p class="text-sm tracking-wider">
                    {{ $comment['body']}}
                </p>
            </div>
        </div>
    </div>
</div>
