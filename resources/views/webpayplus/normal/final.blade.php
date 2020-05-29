@extends('layouts.app')

@section('title', 'Resultado compra')

@section('breadcrumbs')
    <strong>/</strong> <a href="{{ route('payments.index') }}">Pagos</a>
    <strong>/</strong> Resultado compra
@endsection

@section('content')
    <h5>Datos de transacción</h5>
    <ul>
        <li><strong>Orden de compra:</strong> {{ $response->buy_order }}</li>
        <li><strong>Identificador de sesión:</strong> {{ $response->session_id }}</li>
        <li><strong>Fecha de la transacción:</strong> {{ $response->transaction_date }}</li>
        <li><strong>Fecha contable:</strong> {{ $response->accounting_date }}</li>
        <li><strong>VCI:</strong> {{ $response->vci }}</li>
    </ul>
    <h5>Datos de tarjeta</h5>
    <ul>
        <li><strong>Número de tarjeta:</strong> {{ $response->card_number }}</li>
        <li><strong>Expiración de tarjeta:</strong> {{ $response->card_expiration_date }}</li>
    </ul>
    <h5>Resultado de transacción</h5>
    <ul>
        <li><strong>Código de respuesta:</strong> {{ $response->response_code }}</li>
        <li><strong>Descripción de la respuesta:</strong> {{ $response->response_description }}</li>
        <li><strong>Código de comercio:</strong> {{ $response->commerce_code }}</li>
        <li><strong>Monto:</strong> ${{ number_format($response->amount, 0, ',', '.') }}</li>
        <li><strong>Código de autorización:</strong> {{ $response->authorization_code }}</li>
        <li><strong>Tipo de pago de la transacción:</strong> {{ $response->payment_type_code }}</li>
        <li><strong>Cantidad de cuotas:</strong> {{ $response->shares_number }}</li>
    </ul>
@endsection
