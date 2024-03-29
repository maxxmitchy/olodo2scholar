<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\SpecificDomainsOnly;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

final class Premium extends Component
{
    public $first_name;

    public $last_name;

    public $email = '';

    public $password = '';

    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:80', 'unique:users', new SpecificDomainsOnly()],
            'password' => ['required', Password::min(8)->mixedCase()->letters()->numbers()->symbols()->uncompromised()],
        ];
    }

    public function store()
    {
        $this->validate();

        Auth::login($user = User::Create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => '+234**********',
            'password' => Hash::make($this->password),
        ]));

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }

    public function render()
    {
        return view('livewire.premium')->layout('layouts.guest');
    }
}
