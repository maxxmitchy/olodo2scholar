@can('update', $idea)
    <livewire:edit-idea :idea="$idea" />
@endcan

@can('delete', $idea)
    <livewire:delete-idea :idea="$idea" />
@endcan

@auth
    <livewire:mark-idea-as-spam :idea="$idea" />
@endauth

@if(auth()->check() && auth()->user()->isAdmin())
    <livewire:mark-idea-as-not-spam :idea="$idea" />
@endif

@auth
    <livewire:edit-comment />
@endauth

@auth
    <livewire:delete-comment />
@endauth

@auth
    <livewire:mark-comment-as-spam />
@endauth

@if(auth()->check() && auth()->user()->isAdmin())
    <livewire:mark-comment-as-not-spam />
@endif
