<?php

declare(strict_types=1);

namespace App\Http\Livewire\Course\Topic\Discussion;

use App\Models\Topic;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

final class Create extends Component implements HasForms
{
    use InteractsWithForms;

    //form fields
    public $topic;

    public $title;

    public $body;

    public $tags = [];

    public bool $is_question = false;

    //methods
    public function mount(Topic $topic): void
    {
        $this->topic = $topic;
    }

    public function saveDiscussion()
    {
        $this->validate([
            'tags' => ['nullable', 'array', 'max:5'],
        ]);

        $discussion = $this->topic->discussions()->create([
            'title' => $this->title,
            'body' => $this->body,
            'tags' => json_encode($this->tags),
            'is_question' => $this->is_question,
            'user_id' => auth()->user()->id ?? 1,
        ]);

        Notification::make()
            ->title('Dicussion created successfully')
            ->success()
            ->body('If you have any troubles please contact us.')
            ->send();

        return redirect('discussion/' . $discussion->key);
    }

    public function render()
    {
        return view('livewire.course.topic.discussion.create')->layout('layouts.guest');
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('title')
                ->required(),
            RichEditor::make('body')
                ->maxLength(2000)
                ->required(),
            Checkbox::make('Is this a question')->inline(),
        ];
    }
}
