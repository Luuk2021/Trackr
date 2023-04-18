<?php

namespace App\Http\Livewire\Shop;

use App\Models\Shop;
use Livewire\Component;
use Livewire\WithPagination;

class ShowShops extends Component
{
    use WithPagination;

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
        return view('livewire.shop.show-shops', [
            'shops' => Shop::search('name', $this->searchName)->orderBy($this->sortField, $this->sortDirection)->paginate(10),
        ]);
    }

    public function delete(Shop $shop)
    {
        $shop->delete();
    }
}
