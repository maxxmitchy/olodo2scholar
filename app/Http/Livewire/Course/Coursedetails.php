<?php

namespace App\Http\Livewire\Course;

use App\Models\Course;
use Livewire\Component;

class Coursedetails extends Component
{
    public Course $course;

    public function render()
    {
        return view('livewire.course.coursedetails')->layout('layouts.guest');
    }
}
