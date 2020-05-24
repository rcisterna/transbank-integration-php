@extends('layouts.app')

@section('title', 'Pagos')

@section('breadcrumbs')
    <strong>/</strong> Pagos
@endsection

@section('content')
    <div>
        <form action="{{ route('payments.store') }}" method="post">
            $ <input type="number" name="amount" id="amount" placeholder="Monto" autofocus>
            <button>Crear pago</button>
        </form>
    </div>
    @if(!$payments->isEmpty())
        <table>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Monto</th>
            </tr>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->created_at }}</td>
                    <td>{{ $payment->amount }}</td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection
