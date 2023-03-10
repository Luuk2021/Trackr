<?php

namespace App\Http\Livewire\Package;

use App\Models\Package;
use App\Traits\StorePackage;
use Livewire\Component;

class CreatePackage extends Component
{
    use StorePackage;

    public Package $package;

    public function mount()
    {
        $this->package = new Package();
    }

    public function save()
    {
        $this->validate();
        $this->StorePackage($this->package);
        return redirect()->to('/package');
    }

    public function render()
    {
        return view('livewire.package.create-package');
    }
}
