<div class="container p-5 space-y-3">
    <h2 class="tracking-wider text-xl font-semibold">Studyeazy is offering a free trial period.</h2>
    <p class="tracking-wider text-sm">
        Take advantage of this limited time offer and sign up for free services today!
    </p>
    <div class="flex justify-end space-x-4">
        <a href="{{ route('premium') }}" class="text-blue text-sm font-semibold">Sign up</a>
        <a wire:click="$emit('closeModal')" class="text-blue text-sm font-semibold">Got it</a>
    </div>
</div>
