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

    public $searchEmail = '';

    public $searchLastname = '';

    public $searchStatus = '';

    public $searchStreetname = '';

    public $searchZipcode = '';

    public $searchCity = '';

    public $sortField = 'created_at';

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
        return view('livewire.package.show-packages', [
            'packages' => Package::search('lastname', $this->searchLastname)->
            search('email', $this->searchEmail)->
            search('status', $this->searchStatus)->
            search('streetname', $this->searchStreetname)->
            search('zipcode', $this->searchZipcode)->
            search('city', $this->searchCity)->
            orderBy($this->sortField, $this->sortDirection)->paginate(10),
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
