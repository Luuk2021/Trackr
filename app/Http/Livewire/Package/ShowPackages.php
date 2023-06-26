<?php

namespace App\Http\Livewire\Package;

use App\Enum\PackageStatusEnum;
use App\Models\Package;
use App\Traits\StorePackage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rules\File;
use Livewire\WithPagination;

class ShowPackages extends Component
{
    use WithFileUploads, StorePackage, WithPagination;

    public $file;

    public $searchEmail = '';

    public $searchShopname = '';

    public $searchLastname = '';

    public $searchStatus = '';

    public $searchStreetname = '';

    public $searchZipcode = '';

    public $searchCity = '';

    public $sortField = 'shops.name';

    public $sortDirection = 'asc';

    public $selectedPackages = [];

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
            'packages' => Package::select('packages.*', 'shops.name')->join('shops', 'shops.id', '=', 'packages.shop_id')->whereIn('shops.id', Auth::user()->shops->pluck('id'))->search('packages.lastname', $this->searchLastname)->search('packages.email', $this->searchEmail)->search('packages.status', $this->searchStatus)->search('packages.streetname', $this->searchStreetname)->search('packages.zipcode', $this->searchZipcode)->search('packages.city', $this->searchCity)->search('shops.name', $this->searchShopname)->orderBy($this->sortField, $this->sortDirection)->paginate(10),
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
            $package->shop_id = $packageArrayToAdd[7];

            $errors = $this->StorePackage($package);
        }
    }

    public function generatePDF($id)
    {
        $packages = Package::find($id);

        $data = [
            'packages' => $packages
        ];

        $pdf = PDF::loadView('myPDF', $data)->output();
        foreach ($packages as $package) {  
            if ($package->status == PackageStatusEnum::REGISTERED) {
                $package->status = PackageStatusEnum::PRINTED;
                $package->save();
            }
        }
        return response()->streamDownload(fn () => print($pdf), 'trackr_labels.pdf');
    }

    public function generateSelectedPDFs()
    {
        $download = $this->generatePDF($this->selectedPackages);
        $this->selectedPackages = [];
        return $download;
    }

    public function delete(Package $package)
    {
        if (in_array($package->shop_id, Auth::user()->shops->pluck('id')->toArray())) {
            $package->delete();
        }
    }
}
