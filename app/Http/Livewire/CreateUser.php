<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateUser extends Component
{
    public User $users;

    protected $rules = [
        'users.name' => 'required|string|min:1',
        'users.email' => 'required|email|max:500|unique:users',
        'users.password' => 'required|string|min:5',
        'users.role' => 'required|in:admin,packer',
    ];

    public function mount()
    {
        $this->users = new User();
    }

    public function save()
    {
        $this->validate();

        $newUser = User::factory()->create([
            'name' => $this->users->name,
            'email' => $this->users->email,
            'password' => Hash::make($this->users->password),
            'role' => $this->users->role,
        ]);

        $newUser->save();

        return redirect()->to('/user');
    }

    public function render()
    {
        return view('livewire.create-user');
    }
}
