<?php

namespace App\Http\Livewire;

use App\Models\Level;
use App\Models\Course;
use App\Models\Faculty;
use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class Landing extends Component implements HasForms
{
    use InteractsWithForms;
    use WithPagination;

    public $facultyId;

    public $departmentId;

    public $levelId;

    public $search = '';

    public function mount()
    {
        $this->facultyId = 2;
    }

    protected $queryString = [
        'facultyId' => ['as' => 'fac'],
        'departmentId' => ['as' => 'dep'],
        'levelId' => ['as' => 'lev'],
        'search' => ['except' => ''],
    ];

    protected function getFormSchema(): array
    {
        return [
            Select::make('facultyId')
                ->label('Faculty')
                ->options(Faculty::whereHas('departments')->pluck('name', 'id')->toArray())
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

    public function getCoursesProperty()
    {
        return Course::whereHas('department.faculty', function ($query) {
            $query->whereId($this->facultyId);
        })->when($this->levelId, function($query) {
            $query->whereRelation('level', 'id', $this->levelId);
        })->when($this->departmentId, function($query) {
            $query->whereRelation('department', 'id', $this->departmentId);
        })->when($this->search, function($query) {
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
