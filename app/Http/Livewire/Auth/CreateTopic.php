<?php

declare(strict_types=1);

namespace App\Http\Livewire\Auth;

use App\Models\Course;
use App\Models\Topic;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

final class CreateTopic extends Component implements HasForms
{
    use InteractsWithForms;

    public $course;

    public $title = '';

    public $body = '';

    public $overview = '';

    public function mount(Course $course): void
    {
        $this->form->fill();

        $this->course = $course;
    }

    public function rules()
    {
        return [
            'title' => ['required'],
            'overview' => ['required'],
        ];
    }

    public function store()
    {
        $this->validate();

        $topic = Topic::Create([
            'title' => $this->title,
            'body' => '1qwe',
            'overview' => $this->overview,
            'course_id' => $this->course->id,
        ]);

        $this->notify('topic created successfully for course ' . $this->course->title);

        return to_route('auth.view-course-topic', ['course' => $this->course->key, 'topic' => $topic->key]);
    }

    public function render()
    {
        return view('livewire.auth.create-topic');
    }

    protected function getFormSchema(): array
    {
        return [
            RichEditor::make('overview'),
        ];
    }
}
