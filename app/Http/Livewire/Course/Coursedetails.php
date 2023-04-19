<?php

namespace App\Http\Livewire\Course;

use App\Models\Course;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Coursedetails extends Component
{
    public Course $course;

    public function render()
    {
        if (auth()->check() && !Auth::user()->courses->contains($this->course)) {
            // Attach the course to the user
            Auth::user()->courses()->attach($this->course);
        }

        return view('livewire.course.coursedetails')->layout('layouts.guest');
    }
}
