<?php

namespace App\Traits;

use App\Enum\PackageStatusEnum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

trait StorePackage
{
    public function rules()
    {
        return [
            'package.firstname' => [
                'required',
                'string',
                'min:1',
            ],
            'package.email' => [
                'required',
                'email',
                'max:500',
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
            'package.shop_id' => [
                'required',
                'integer',
                Rule::in(Auth::user()->shops->pluck('id')),
            ],
        ];
    }

    public function StorePackage($package)
    {
        $validator = Validator::make(
            ['package' => $package],
            $this->rules(),
        );

        if (!$validator->fails()) {
            $package->status = PackageStatusEnum::REGISTERED;

            $user = User::select('id')->where('email', $package->email)->first();
            if (!is_null($user)) {
                $package->user_id = $user->id;
            }

            $package->pairing_code = (string) Str::uuid();

            $package->save();
        }

        return $validator->errors()->get('*');
    }
}
