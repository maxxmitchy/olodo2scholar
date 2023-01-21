<?php

namespace App\Http\Livewire\Auth;

use Closure;
use Livewire\Component;
use App\Models\Question;
use App\Models\QuestionBank;
use Illuminate\Support\Collection;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Concerns\InteractsWithTable;

class ViewQuestions extends Component implements HasTable
{
    use InteractsWithTable;

    public $qbankId;

    public function mount($question_bank)
    {
        $this->qbankId = QuestionBank::where('key', $question_bank)->first()->id;
    }

    protected function getTableQuery(): Builder
    {
        $query = Question::query();
        $query->where('questionable_id', $this->qbankId)->where('questionable_type', 'App\Models\QuestionBank')->orderBy('created_at', 'desc')->get();
        return $query;
    }

    protected function getTableColumns(): array
    {
        return [TextColumn::make('content')->searchable(), TextColumn::make('explanation')];
    }

    protected function getTableActions(): array
    {
        return [Action::make('edit')->url(fn(Question $record): string => route('auth.editquestion', ['record' => $record]))];
    }

    protected function getTableBulkActions(): array
    {
        return [
            BulkAction::make('delete')
                ->label('Delete selected')
                ->color('danger')
                ->action(function (Collection $records): void {
                    $records->each->delete();
                })
                ->requiresConfirmation(),
        ];
    }

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [5, 10, 25, 50, 100];
    }

    public function isTableSearchable(): bool
    {
        return true;
    }

    protected function applySearchToTableQuery(Builder $query): Builder
    {
        if (filled($searchQuery = $this->getTableSearchQuery())) {
            $query->whereIn('id', Question::search($searchQuery)->keys());
        }

        return $query;
    }

    protected function getTableRecordUrlUsing(): Closure
    {
        return fn(Question $record): string => route('auth.editquestion', ['record' => $record]);
    }

    protected function getTableEmptyStateIcon(): ?string
    {
        return 'heroicon-o-bookmark';
    }

    protected function getTableEmptyStateHeading(): ?string
    {
        return 'No questions yet';
    }

    public function render()
    {
        return view('livewire.auth.view-questions');
    }
}
