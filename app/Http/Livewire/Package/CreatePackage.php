<?php

namespace App\Http\Livewire\Package;

use App\Models\Package;
use App\Models\Shop;
use App\Traits\StorePackage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreatePackage extends Component
{
    use StorePackage;

    public Package $package;

    public $searchName = '';
    public $allShops;

    public function mount()
    {
        $this->package = new Package();
        $this->allShops = Auth::user()->shops;
    }

    public function save()
    {
        $this->validate();
        $this->StorePackage($this->package);
        return redirect()->to('/package');
    }

    public function render()
    {
        return view('livewire.package.create-package',
        ['shopsToShow' => Shop::whereIn('shops.id', Auth::user()->shops->pluck('id'))
        ->search('name', $this->searchName)->get('id')]);
    }
}
