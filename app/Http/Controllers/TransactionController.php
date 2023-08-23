<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function transaction()
    {
        // get data
        $transactions = Transaction::get();
        $debitAmount = Transaction::where('type','debit')->sum('amount');
        $creditAmount = Transaction::where('type','credit')->sum('amount');
        $balanceAmount=$creditAmount-$debitAmount;

        // return
        return view('transactions.transaction',compact('transactions','balanceAmount'));
    }

    public function createTransaction(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'transactionType' => 'required',
        ]);

        if (!$validator->passes()) {
            // not valid
            return back()->with('dangerMsg', "Some required fields missing");
        } else {

            // valid
            $amount = $request->amount;
            $transactionType = $request->transactionType;

            // save to database
            $transaction = new Transaction();
            $transaction->amount = $amount;
            $transaction->type = $transactionType;

            $transaction->save();

            // return
            return back()->with('status', "Transaction added success");
        }
    }

    public function pdf()
    {
        // get data
        $transactions = DB::table('transactions')->get();
        $debitAmount = Transaction::where('type','debit')->sum('amount');
        $creditAmount = Transaction::where('type','credit')->sum('amount');
        $balance=number_format($creditAmount-$debitAmount,2);

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
