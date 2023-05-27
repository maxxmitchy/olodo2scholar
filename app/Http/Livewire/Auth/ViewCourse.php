<?php

declare(strict_types=1);

namespace App\Http\Livewire\Auth;

use App\Models\Course;
use Livewire\Component;

final class ViewCourse extends Component
{
    public $course;

    public function mount(Course $course): void
    {
        $this->course = $course::where('key', $this->course->key)->with('topics')->first();
    }

    public function render()
    {
        return view('livewire.auth.view-course');
    }
}
