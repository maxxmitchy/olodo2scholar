<nav class="hidden md:flex items-center justify-between text-gray-400 text-xs">
    <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
        <li>
            <a wire:click.prevent="setStatus('All')"
                href="{{ route('idea.index', ['status' => 'All', 'topic' => session('topic')->key]) }}"
                class="border-b-4 pb-3 hover:border-purplee @if ($status === 'All') border-purplee text-gray-900 @endif">
                All Ideas ({{ $statusCount['all_statuses'] }})
            </a>
        </li>
        <li><a wire:click.prevent="setStatus('Considering')"
                href="{{ route('idea.index', ['status' => 'Considering', 'topic' => session('topic')->key]) }}"
                class=" transition duration-150 ease-in border-b-4 pb-3 hover:border-purplee @if ($status === 'Considering') border-purplee text-gray-900 @endif">Considering
                ({{ $statusCount['considering'] }})</a></li>
        <li><a wire:click.prevent="setStatus('In Progress')"
                href="{{ route('idea.index', ['status' => 'In Progress', 'topic' => session('topic')->key]) }}"
                class=" transition duration-150 ease-in border-b-4 pb-3 hover:border-purplee @if ($status === 'In Progress') border-purplee text-gray-900 @endif">In
                Progress ({{ $statusCount['in_progress'] }})</a></li>
    </ul>

    <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
        <li><a wire:click.prevent="setStatus('Implemented')"
                href="{{ route('idea.index', ['status' => 'Implemented', 'topic' => session('topic')->key]) }}"
                class=" transition duration-150 ease-in border-b-4 pb-3 hover:border-purplee @if ($status === 'Implemented') border-purplee text-gray-900 @endif">Implemented
                ({{ $statusCount['implemented'] }})</a></li>
        <li><a wire:click.prevent="setStatus('Closed')"
                href="{{ route('idea.index', ['status' => 'Closed', 'topic' => session('topic')->key]) }}"
                class=" transition duration-150 ease-in border-b-4 pb-3 hover:border-purplee @if ($status === 'Closed') border-purplee text-gray-900 @endif">Closed
                ({{ $statusCount['closed'] }})</a></li>
    </ul>
</nav>
