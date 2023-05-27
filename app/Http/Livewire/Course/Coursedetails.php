<?php

declare(strict_types=1);

namespace App\Http\Livewire\Course;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

final class Coursedetails extends Component
{
    public Course $course;

    public function render()
    {
        if (auth()->check() && ! Auth::user()->courses->contains($this->course)) {
            // Attach the course to the user
            Auth::user()->courses()->attach($this->course);
        }

        return view('livewire.course.coursedetails')->layout('layouts.guest');
    }
}
