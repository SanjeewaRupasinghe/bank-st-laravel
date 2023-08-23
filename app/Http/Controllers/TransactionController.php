<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class TransactionController extends Controller
{
    public function index()
    {

        $transactions = DB::table('transactions')->get();
        $balance = DB::table('transactions')->sum('amount');

        $pdf = new Dompdf();

        // Generate the PDF content
        $pdfContent = View::make('transactions.pdf', compact('transactions', 'balance'))->render();
        $pdf->loadHtml($pdfContent);

        // (Optional) Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');

        // Render the PDF
        $pdf->render();

        return view('transactions.index', compact('transactions', 'balance'));
    }

    public function pdf()
    {
        $transactions = DB::table('transactions')->get();
        $balance = DB::table('transactions')->sum('amount');

        $pdf = new Dompdf();

        // Generate the PDF content
        $pdfContent = View::make('transactions.pdf', compact('transactions', 'balance'))->render();
        $pdf->loadHtml($pdfContent);

        // (Optional) Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');

        // Render the PDF
        $pdf->render();

        // Download the PDF
        return $pdf->stream('transaction_history.pdf');
    }
}
