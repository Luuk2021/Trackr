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
    public function generatePDF()
    {
        $package = Package::find(1);

        $data = [
            'title' => 'Welcome to Trackr',
            'date' => date('d/m/Y'),
            'package' => $package
        ];

        $pdf = PDF::loadView('myPDF', $data);
//        dd($pdf);
        return $pdf->download('trackr_label_' . $package->id . '.pdf');
    }
}
