<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class ShowUsers extends Component
{
    public function render()
    {
        return view('livewire.user.show-users', [
            'users' => User::all()
        ]);
    }

    public function delete(User $user)
    {
        $user->delete();
    }
}
