<?php

namespace App\Http\Livewire\Package;

use App\Enum\PackageStatusEnum;
use App\Models\Package;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CreatePackage extends Component
{
    public Package $package;

    public function rules()
    {
        return [
            'package.email' => [
                'required',
                'email',
                'max:500',
            ],
        ];
    }

    public function mount()
    {
        $this->package = new Package();
    }

    public function save()
    {
        $this->validate();

        $this->package->status = PackageStatusEnum::REGISTERED;
        $this->package->user_id = User::select('id')->where('email', $this->package->email)->first();
        $this->package->pairing_code = (string) Str::uuid();

        $this->package->save();

        return redirect()->to('/package');
    }

    public function render()
    {
        return view('livewire.package.create-package');
    }
}
