<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\Rule;

class EditUser extends Component
{
    public User $users;

    public function rules()
    {
        return [
            'users.name' => 'required|string|min:1',
            'users.email' => [
                'required',
                'email',
                'max:500',
                Rule::unique('users', 'email')->ignore($this->users->id),
            ],
            'users.password' => 'string|min:5',
            'users.role' => 'required|in:admin,packer,superadmin',
        ];
    }

    public function mount($user)
    {
        $this->users = User::find($user);
        $this->users->password = '';
    }

    public function save()
    {
        $this->validate();

        if ($this->users->password == '') {
            $this->users->password = User::find($this->users->id)->password;
        } else {
            $this->users->password = Hash::make($this->users->password);
        }

        $this->users->save();

        return redirect()->to('/user');;
    }

    public function render()
    {
        return view('livewire.user.edit-user');
    }
}
