<?php

declare(strict_types=1);

namespace App\Http\Livewire\Auth;

use App\Models\Course;
use App\Models\Difficulty;
use App\Models\Quiz;
use App\Models\Topic;
use Livewire\Component;

final class ViewCourseTopic extends Component
{
    public $difficulty = 1;

    public $name;

    public $description;

    public Topic $topic;

    public Course $course;

    public function rules()
    {
        return [
            'name' => ['required'],
            'difficulty' => ['required'],
        ];
    }

    public function store()
    {
        $quiz = Quiz::create([
            'name' => $this->name,
            'difficulty_id' => $this->difficulty,
            'topic_id' => $this->topic['id'],
        ]);

        return to_route('auth.create-question', ['quiz' => $quiz]);
    }

    public function render()
    {
        $difficulties = Difficulty::all();

        return view('livewire.auth.view-course-topic', [
            'difficulties' => $difficulties,
        ]);
    }
}
