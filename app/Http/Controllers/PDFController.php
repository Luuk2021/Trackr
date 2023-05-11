<?php

namespace App\Http\Controllers;

use App\Models\Package;
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
//        dd($request);
        $package = Package::find($id);

        $data = [
            'title' => 'Welcome to Trackr',
            'date' => date('d/m/Y'),
            'package' => $package
        ];

        $pdf = PDF::loadView('myPDF', $data);
        return $pdf->download('trackr_label_' . $package->id . '.pdf');
    }
}
