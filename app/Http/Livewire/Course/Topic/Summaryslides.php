<?php

namespace App\Http\Livewire\Course\Topic;

use App\Models\Summary;

use Livewire\Component;

class Summaryslides extends Component
{
    public $summary;

    public function mount(Summary $summary)
    {
        $this->summary = $summary;
    }

    public function render()
    {
        return view('livewire.course.topic.summaryslides')->layout('layouts.guest');
    }
}
