<?php

namespace App\Http\Controllers;

use App\Enum\PackageStatusEnum;
use App\Models\Package;
use App\Traits\StorePackage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            return response()->json($package, 201);
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

    public function update(Request $request, Package $package)
    {
        if (!in_array($package->shop_id, Auth::user()->shops->pluck('id')->toArray())) {
            return response()->json([], 403);
        }

        try {
            $request->validate([
                'status' => [
                    'required',
                    Rule::in(array_column(PackageStatusEnum::cases(), 'value')),
                ],
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }

        $package->status = $request->status;
        $package->save();
    }
}
