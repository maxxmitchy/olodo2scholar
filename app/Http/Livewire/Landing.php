<?php

namespace App\Http\Livewire;

use App\Mail\ContactUsEmail;
use App\Models\Course;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Faq;
use App\Models\Level;
use App\Models\University;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\SpecificDomainsOnly;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class Landing extends Component implements HasForms
{
    use InteractsWithForms;
    use WithPagination;

    public $universityId;

    public $facultyId;

    public $departmentId;

    public $levelId;

    public $search = '';

    public $status = 'recent';

    public $email;

    public $infor;

    public function mount()
    {
        if (is_null(Faculty::first())) {
            $this->facultyId = 'No faculty found';
        } else {
            $this->facultyId = Faculty::first()->id;
        }
    }

    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email', 'max:80', 'unique:users', new SpecificDomainsOnly()],
        ];
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

    public function getCourseStatProperty()
    {
        return Course::where('status', $this->status)->get()->take(10);
    }

    public function getCoursesProperty()
    {
        $minutes = 1;

        $cacheKey = 'courses:faculty_id='.$this->facultyId.':level_id='.$this->levelId.':department_id='.$this->departmentId.':search='.$this->search;

        $results = Cache::remember($cacheKey, $minutes, function () {
            $query = Course::whereHas('department.faculty', function ($query) {
                $query->whereId($this->facultyId);
            });

            if ($this->levelId) {
                $query->whereRelation('level', 'id', $this->levelId);
            }

            if ($this->departmentId) {
                $query->whereRelation('department', 'id', $this->departmentId);
            }

            if ($this->search) {
                $query->where(function ($query) {
                    $query->where('title', 'like', '%'.$this->search.'%')
                        ->orWhere('description', 'like', '%'.$this->search.'%')
                        ->orWhere('code', 'like', '%'.$this->search.'%');
                });
            }

            return $query->get();
        });

        return $results;
    }

    public function getFacultiesProperty()
    {
        return Faculty::whereHas('departments', function ($query) {
            $query->whereHas('courses');
        })->whereHas('university', function ($query) {
            $query->whereId($this->universityId);
        })->get();
    }

    public function getDepartmentsProperty()
    {
        return Department::whereHas('faculty', function ($query) {
            $query->whereId($this->facultyId);
        })->whereHas('courses')->get();
    }

    public function getLevelsProperty()
    {
        return Level::whereHas('courses', function ($query) {
            $query->whereRelation('department', 'faculty_id', $this->facultyId)
            ->whereRelation('department', 'id', $this->departmentId);
        })->get();
    }

    public function contactUs()
    {
        $this->validate([
            'email' => 'required|email',
            'infor' => 'required',
        ]);

        Mail::to(config('app.admin_email'))->send(new ContactUsEmail($this->email, $this->infor));

        Notification::make()
        ->title('Email Sent successfully')
        ->success()
        ->body('Thanks for reaching out to us, we will get back to you shortly.')
        ->send();

        $this->reset(['email', 'infor']);
    }

    public function store()
    {
        $this->validate();

        Auth::login($user = User::Create([
            'first_name' => $this->first_name ?? 'John',
            'last_name' => $this->last_name ?? 'Doe',
            'email' => $this->email,
            'phone' => '+234**********',
            'password' => Hash::make('password'),
        ]));

        event(new Registered($user));

        // send user email

        return redirect(RouteServiceProvider::HOME);
    }

    public function render()
    {
        $faqs = Faq::all();

        return view('livewire.landing', [
            'faqs' => $faqs,
        ])->layout('layouts.guest');
    }
}
