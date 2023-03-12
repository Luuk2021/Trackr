<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Traits\StorePackage;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    use StorePackage;

    public function store(Request $request)
    {
        $package = new Package();
        $data = $request->only($package->getFillable());
        $package->Fill($data);
        $errors = $this->StorePackage($package);

        if (empty($errors)) {
            return response()->json($package,201);
        } else {
            return response()->json(
                [
                    "errors" => $errors,
                    "request" => $request,
                ],
                400
            );
        };
    }
}
