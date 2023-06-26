<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUsersAdmin extends Component
{
    use WithPagination;

    public $searchEmail = '';

    public $searchName = '';

    public $sortField = 'id';

    public $sortDirection = 'desc';

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
        $shops = Auth::user()->shops;
        $ids = collect();

        foreach ($shops as $shop) {
            foreach ($shop->packages as $package) {
                if (!$ids->contains($package->user_id)) {
                    $ids->push($package->user_id);
                }
            }
        }


        //dd($users);
        return view('livewire.user.show-users-admin', [
            'users' => User::whereIn('id', $ids)->
            search('email', $this->searchEmail)->
            search('name', $this->searchName)->
            orderBy($this->sortField, $this->sortDirection)->paginate(10),
        ]);
    }
}
