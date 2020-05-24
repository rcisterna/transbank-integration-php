<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::orderBy('created_at', 'desc')->get();
        return view('payments.index', compact('payments'));
    }

    public function store(Request $request)
    {
        $payment = Payment::create($request->all());
        return view('payments.select_payment_method', compact('payment'));
    }
}
