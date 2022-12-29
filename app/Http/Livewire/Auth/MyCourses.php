<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class MyCourses extends Component
{
    public function render()
    {
        $courses = User::find(auth()->id())->courses()->get();

        return view('livewire.auth.my-courses', [
            'courses' => $courses,
        ]);
    }
}
