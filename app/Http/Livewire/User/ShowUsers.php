<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUsers extends Component
{
    use WithPagination;

    public $search = '';

    public $sortField = 'id';

    public $sortDirection = 'desc';

    public $searchColumn = 'email';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.user.show-users', [
            'users' => User::search($this->searchColumn, $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10),
        ]);
    }

    public function delete(User $user)
    {
        $user->delete();
    }
}
