<?php

namespace App\Http\Livewire\Course\Topic\Discussion;

use App\Models\Discussion;
use Livewire\Component;

class View extends Component
{
    public $discussion;

    public function mount(Discussion $discussion)
    {
        $this->discussion = $discussion;
    }

    public function render()
    {
        return view('livewire.course.topic.discussion.view')->layout('layouts.guest');
    }
}
