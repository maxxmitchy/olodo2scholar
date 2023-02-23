<?php

namespace App\Http\Livewire\Course\Topic;

use App\Models\Summary;
use Livewire\Component;

class Viewsummary extends Component
{
    public $summary;

    public function mount(Summary $summary)
    {
        $this->summary = $summary;
    }

    public function render()
    {
        return view('livewire.course.topic.viewsummary')->layout('layouts.guest');
    }
}
