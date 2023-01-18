<?php

namespace App\Http\Livewire\Onboarding;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Level;
use App\Models\University;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

class Studentprofile extends Component implements HasForms
{
    use InteractsWithForms;

    public $universityId;

    public $facultyId;

    public $departmentId;

    public $levelId;

    public function mount()
    {
        $this->facultyId = auth()->user()->faculty_id;
        $this->universityId = auth()->user()->university_id;
        $this->levelId = auth()->user()->level_id;
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('universityId')
                ->label('University')
                ->options(University::whereHas('faculties')->pluck('name', 'id')->toArray())
                ->reactive()
                ->afterStateUpdated(fn (callable $set) => $set('facultyId', null))
                ->searchable(),
            Select::make('facultyId')
                ->label('Faculty')
                ->options(function (callable $get) {
                    $university = University::with('faculties')->find($get('universityId'));

                    if (! $university) {
                        return Faculty::whereHas('departments')->pluck('name', 'id')->toArray();
                    }

                    return $university->faculties()
                        ->select('faculties.name', 'faculties.id')
                        ->pluck('name', 'id');
                })
                ->reactive()
                ->afterStateUpdated(fn (callable $set) => $set('departmentId', null))
                ->searchable(),
            Select::make('departmentId')
                ->label('Department')
                ->options(function (callable $get) {
                    $faculty = Faculty::with('departments')->find($get('facultyId'));

                    if (! $faculty) {
                        return Department::whereHas('courses')->pluck('name', 'id')->toArray();
                    }

                    return $faculty->departments->pluck('name', 'id');
                })
                ->reactive()
                ->searchable(),
            Select::make('levelId')
                ->label('Level')
                ->options(Level::all()->pluck('name', 'id')->toArray())
                ->reactive()
                ->searchable(),
        ];
    }

    public function update()
    {
        auth()->user()->update([
            'university_id' => $this->universityId,
            'department_id' => $this->departmentId,
            'level_id' => $this->levelId,
        ]);

        Notification::make()
        ->title('Student Profile Updated successfully')
        ->success()
        ->body('Now you will be the first to know when we have courses for your class.')
        ->send();

        return to_route('dashboard');
    }

    public function render()
    {
        return view('livewire.onboarding.studentprofile');
    }
}
