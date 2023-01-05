<?php

namespace App\Http\Livewire;

use App\Jobs\NotifyAllVoters;
use App\Models\Idea;
use Illuminate\Http\Response;
use Livewire\Component;

class SetStatus extends Component
{
    public $idea;

    public $status;

    public $comment;

    public $notifyAllVoters;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        $this->status = $this->idea->status_id;
    }

    public function setStatus()
    {
        if (auth()->guest() || ! auth()->user()->isAdmin()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        if ($this->idea->status_id === (int) $this->status) {
            $this->emit('statusWasUpdatedError', 'Status is the same!');

            return;
        }

        $this->idea->status_id = $this->status;
        $this->idea->save();

        if ($this->notifyAllVoters) {
            NotifyAllVoters::dispatch($this->idea);
        }

        $this->idea->comment(
            content: $this->comment ?? 'No comment was added.',
            user: auth()->user(),
            status: $this->status,
            isStatusUpdate : true,
        );

        $this->reset('comment');

        $this->emit('statusWasUpdated', 'Status was updated successfully!');
    }

    public function render()
    {
        return view('livewire.set-status');
    }
}