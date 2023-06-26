<?php

namespace App\Http\Livewire\Shop;

use App\Models\Shop;
use Livewire\Component;

class EditShop extends Component
{
    public Shop $shop;

    public function rules()
    {
        return [
            'shop.name' => [
                'required',
                'string',
                'min:1',
            ],
            'shop.streetname' => [
                'required',
                'string',
                'min:1',
            ],
            'shop.housenumber' => [
                'required',
                'string',
                'min:1',
            ],
            'shop.zipcode' => [
                'required',
                'string',
                'min:1',
            ],
            'shop.city' => [
                'required',
                'string',
                'min:1',
            ],
        ];
    }

    public function mount($shop)
    {
        $this->shop = $shop;
    }

    public function save()
    {
        $this->validate();

        $this->shop->save();

        return redirect()->to('/shop');;
    }

    public function render()
    {
        return view('livewire.shop.edit-shop');
    }
}
