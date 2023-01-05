<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Level;
use App\Models\University;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Livewire\WithPagination;

class LandingOld extends Component implements HasForms
{
    use InteractsWithForms;
    use WithPagination;

    public $universityId;

    public $facultyId;

    public $departmentId;

    public $levelId;

    public $search = '';

    public $status = 'recent';

    public function mount()
    {
        if (is_null(Faculty::first())) {
            $this->facultyId = 'No faculty found';
        } else {
            $this->facultyId = Faculty::first()->id;
        }
    }

    protected $queryString = [
        'universityId' => ['as' => 'uni'],
        'facultyId' => ['as' => 'fac'],
        'departmentId' => ['as' => 'dep'],
        'levelId' => ['as' => 'lev'],
        'search' => ['except' => ''],
        'status' => ['as' => 's'],
    ];

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
                    $university = University::find($get('universityId'));

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
                    $faculty = Faculty::find($get('facultyId'));

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

    public function getCourseStatProperty()
    {
        return Course::where('status', $this->status)->get()->take(10);
    }

    public function getCoursesProperty()
    {
        return Course::whereHas('department.faculty', function ($query) {
            $query->whereId($this->facultyId);
        })->when($this->levelId, function ($query) {
            $query->whereRelation('level', 'id', $this->levelId);
        })->when($this->departmentId, function ($query) {
            $query->whereRelation('department', 'id', $this->departmentId);
        })->when($this->search, function ($query) {
            $query->where('title', 'like', '%'.$this->search.'%');
        })->get();
    }

    public function render()
    {
        // Route::get('/get-editors', function () {
        //     $editors = \App\Models\User::where('role', \App\Enum\UserRoleEnum::EDITOR)->get();
        //     dd($editors);
        // });
        // Route::get('/get-all-enums', function (){
        //     dd(\App\Enum\UserRoleEnum::cases());
        // });

        return view('livewire.landing')->layout('layouts.guest');
    }
}
