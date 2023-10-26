<?php

namespace App\Http\Controllers;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->get();

        return view('transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function export(string $transaction)
    {
        $transaction = Transaction::find($transaction);
        return view('transactions.export', compact('transaction'));
    }

    public function duplicate(string $transaction)
    {
        $transaction = Transaction::where("uuid", $transaction)->first();

        return view('transactions.duplicate', compact('transaction'));
    }
}
