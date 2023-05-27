<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Livewire\Component;

final class Search extends Component
{
    public string $search = '';

    public function render()
    {
        return view('livewire.search');
    }
}
