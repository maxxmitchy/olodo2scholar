<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Search extends Component
{
    public string $search = "";

    public function render()
    {
        return view('livewire.search');
    }
}
