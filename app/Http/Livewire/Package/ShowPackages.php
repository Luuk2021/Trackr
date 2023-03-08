<?php

namespace App\Http\Livewire\Package;

use App\Models\Package;
use Livewire\Component;

class ShowPackages extends Component
{
    public function render()
    {
        return view('livewire.package.show-packages', [
            'packages' => Package::all()
        ]);
    }

    public function delete(Package $package)
    {
        $package->delete();
    }
}
