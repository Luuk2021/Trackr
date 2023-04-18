<?php

namespace App\Http\Livewire\User;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\Rule;

class EditUser extends Component
{
    public User $users;

    public $searchName = '';
    public $allShops;
    public $selectedShopIds = [];

    public $alreadyAuthorizedShopIds = [];

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
            'selectedShopIds' => 'required',
        ];
    }

    public function mount($user)
    {
        $this->users = User::find($user);
        $this->users->password = '';

        $this->allShops = Shop::all();

        $this->alreadyAuthorizedShopIds = $this->users->shops->pluck('id')->toArray();
        $this->selectedShopIds = $this->alreadyAuthorizedShopIds;
    }

    public function save()
    {
        $this->validate();

        if ($this->users->password == '') {
            $this->users->password = User::find($this->users->id)->password;
        } else {
            $this->users->password = Hash::make($this->users->password);
        }

        $shopsToRemove = array_diff($this->alreadyAuthorizedShopIds, $this->selectedShopIds);
        $this->users->shops()->detach($shopsToRemove);

        $shopsToAdd = array_diff($this->selectedShopIds, $this->alreadyAuthorizedShopIds);
        $this->users->shops()->attach($shopsToAdd);

        $this->users->save();

        return redirect()->to('/user');;
    }

    public function render()
    {
        return view(
            'livewire.user.edit-user',
            ['shopsToShow' => Shop::search('name', $this->searchName)->get('id')]
        );
    }
}
