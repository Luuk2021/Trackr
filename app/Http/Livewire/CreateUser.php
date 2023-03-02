<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateUser extends Component
{
    public User $users ;

    protected $rules = [
        'users.name' => 'required|string|min:1',
        'users.email' => 'required|email|max:500|unique:users',
        'users.password' => 'required|string|min:5',
        'users.role' => 'required|in:admin,packer',
    ];

    public function mount()
    {
        $this->users = \App\Models\User::factory()->create();
    }

    public function save()
    {
        $this->validate();

        $passWord = Hash::make($this->users->password);
        $this->users->password = $passWord;

        $this->users->save();

        return redirect()->to('/user');
    }

    public function render()
    {
        return view('livewire.create-user');
    }
}