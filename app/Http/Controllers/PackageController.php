<?php

namespace App\Http\Controllers;

use App\Enum\PackageStatusEnum;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        ]);

        $package = new Package();
        $package->status = PackageStatusEnum::REGISTERED;

        $package->user_id = User::select('id')->where('email', $request->email)->first();
        $package->pairing_code = (string) Str::uuid();

        $package->email = $request->email;
        $package->firstname = $request->firstname;
        $package->lastname = $request->lastname;
        $package->streetname = $request->streetname;
        $package->house_number = $request->house_number;
        $package->zip_code = $request->zip_code;
        $package->city = $request->city;

        $package->save();
    }

}
