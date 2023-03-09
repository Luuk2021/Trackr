<?php

namespace App\Http\Livewire\Package;

use App\Models\Package;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rules\File;

class ShowPackages extends Component
{
    use WithFileUploads;

    public $file;

    public function render()
    {
        return view('livewire.package.show-packages', [
            'packages' => Package::all()
        ]);
    }

    public function import()
    {
        $this->validate([
            'file' => [
                'required',
                File::types(['csv',])
                    ->max(20000)
            ],
        ]);

        dd($this->file);


        //logic to read the file
    }

    public function delete(Package $package)
    {
        $package->delete();
    }
}
