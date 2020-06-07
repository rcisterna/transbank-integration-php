@extends('layouts.app')

@section('title', 'Seleccion pago')

@section('breadcrumbs')
    <strong>/</strong> <a href="{{ route('payments.index') }}">Pagos</a>
    <strong>/</strong> Seleccion de método de pago
@endsection

@section('content')
    <ul>
        <li><a href="{{ route('webpayplus_normal.init', ['paymentId' => $payment->id]) }}">Webpay Plus Normal</a></li>
        <li><a href="{{ route('oneclick_normal.show', ['paymentId' => $payment->id]) }}">Oneclick Normal</a></li>
    </ul>
@endsection
