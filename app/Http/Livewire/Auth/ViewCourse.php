<?php

namespace App\Http\Livewire\Auth;

use App\Models\Course;
use Livewire\Component;

class ViewCourse extends Component
{
    public $course;

    public function mount(Course $course)
    {
        $this->course = $course::where('key', $this->course->key)->with('topics')->first();
    }

    public function render()
    {
        return view('livewire.auth.view-course');
    }
}
