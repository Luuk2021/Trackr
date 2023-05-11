<?php

namespace App\Http\Controllers;

use App\Enum\PackageStatusEnum;
use App\Models\Package;
use App\Http\Controllers\PackageController;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF(Request $request, $id)
    {
        $package = Package::find($id);

        $data = [
            'packages' => [$package]
        ];

        $pdf = PDF::loadView('myPDF', $data);

        if ($package->status == PackageStatusEnum::REGISTERED) {
            $package->status = PackageStatusEnum::PRINTED;
            $package->save();
        }
        return $pdf->download('trackr_label_' . $package->id . '.pdf');
    }
}
