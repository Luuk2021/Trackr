<?php

namespace App\Http\Livewire\Package;

use App\Models\Package;
use App\Traits\StorePackage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rules\File;

class ShowPackages extends Component
{
    use WithFileUploads, StorePackage;

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

        $lines = explode(PHP_EOL, $this->file->get());
        $count = 0;

        foreach ($lines as $line) {
            $count++;

            // delete first 3 chars because csv import has these
            if ($count == 1) {
                $line = substr($line, 3);
            }

            $packageArrayToAdd = str_getcsv($line);
            if (is_null($packageArrayToAdd[0])) {
                continue;
            }

            $package = new Package();
            $package->email = $packageArrayToAdd[0];
            $package->firstname = $packageArrayToAdd[1];
            $package->lastname = $packageArrayToAdd[2];
            $package->streetname = $packageArrayToAdd[3];
            $package->housenumber = $packageArrayToAdd[4];
            $package->zipcode = $packageArrayToAdd[5];
            $package->city = $packageArrayToAdd[6];

            $errors = $this->StorePackage($package);
        }
    }

    public function delete(Package $package)
    {
        $package->delete();
    }
}
