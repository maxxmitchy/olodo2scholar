<div wire:ignore class="flex gap-1 p-2">
    <template x-for="(slide, index) in slides">
        <span :class="(start_slide >= index) ? 'bg-white' : 'bg-white/[0.5]'" class="w-full h-1 rounded"></span>
    </template>
</div>
