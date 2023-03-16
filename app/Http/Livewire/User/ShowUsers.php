<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUsers extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.user.show-users', [
            'users' => User::paginate(10),
        ]);
    }

    public function delete(User $user)
    {
        $user->delete();
    }
}
