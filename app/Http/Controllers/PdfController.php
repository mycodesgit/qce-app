<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    public function genPDF()
    {
        $pdf = PDF::loadView('pdf')->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }

    public function genPDF2()
    {
        $pdf = PDF::loadView('pdfComments')->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }

    public function genPDF3()
    {
        $pdf = PDF::loadView('pdfPoints')->setPaper('Legal', 'landscape');
        return $pdf->stream();
    }

    public function genPDF4()
    {
        $pdf = PDF::loadView('pdfSumSheet')->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }
}
