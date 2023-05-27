<?php

declare(strict_types=1);

namespace App\Http\Livewire\Auth;

use App\Models\Option;
use App\Models\Question;
use Closure;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;

final class ViewQuestionAndOptions extends Component implements HasTable
{
    use InteractsWithTable;

    public $question;

    public function mount(): void
    {
        $this->question = Question::where('id', request()->query('record'))->with('options')->first();
    }

    public function render()
    {
        return view('livewire.auth.view-question-and-options');
    }

    protected function getTableQuery(): Builder
    {
        $query = Option::query();
        $query->where('question_id', $this->question->id)->get();

        return $query;
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('body')->searchable(),
            IconColumn::make('correct_option')->boolean(),
        ];
    }

    // protected function getTableRecordUrlUsing(): Closure
    // {
    //     return fn(Question $record): string => route('auth.editquestion', ['record' => $record]);
    // }

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [5];
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
}
