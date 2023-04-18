<?php

namespace App\Http\Livewire\Package;

use App\Models\Package;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowPackagesRecipient extends Component
{
    public $searchEmail = '';

    public $searchShopname = '';

    public $searchLastname = '';

    public $searchStatus = '';

    public $searchStreetname = '';

    public $searchZipcode = '';

    public $searchCity = '';

    public $sortField = 'shops.name';

    public $sortDirection = 'asc';

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
        return view('livewire.package.show-packages-recipient', [
            'packages' => Package::select('packages.*', 'shops.name')->
            join('shops', 'shops.id', '=', 'packages.shop_id')->
            where('packages.user_id', Auth::user()->id)->
            search('packages.lastname', $this->searchLastname)->
            search('packages.email', $this->searchEmail)->
            search('packages.status', $this->searchStatus)->
            search('packages.streetname', $this->searchStreetname)->
            search('packages.zipcode', $this->searchZipcode)->
            search('packages.city', $this->searchCity)->
            search('shops.name', $this->searchShopname)->
            orderBy($this->sortField, $this->sortDirection)->paginate(10),
        ]);
    }
}
