<?php

namespace App\Http\Livewire\Modal;

use LivewireUI\Modal\ModalComponent;

class Flashcard extends ModalComponent
{
    public function render()
    {
        return view('livewire.modal.flashcard');
    }
}
