<?php

namespace App\Http\Livewire\Package;

use App\Enum\PackageStatusEnum;
use App\Models\Package;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\isNull;

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
            'package.firstname' => [
                'required',
                'string',
                'min:1',
            ],
            'package.lastname' => [
                'required',
                'string',
                'min:1',
            ],
            'package.streetname' => [
                'required',
                'string',
                'min:1',
            ],
            'package.housenumber' => [
                'required',
                'string',
                'min:1',
            ],
            'package.zipcode' => [
                'required',
                'string',
                'min:1',
            ],
            'package.city' => [
                'required',
                'string',
                'min:1',
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
        $user = User::select('id')->where('email', $this->package->email)->first();

        if (!is_null($user)) {
            $this->package->user_id = $user->id;
        }
        $this->package->pairing_code = (string) Str::uuid();

        $this->package->save();

        return redirect()->to('/package');
    }

    public function render()
    {
        return view('livewire.package.create-package');
    }
}
