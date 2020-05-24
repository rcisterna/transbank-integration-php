@extends('layouts.app')

@section('title', 'Seleccion pago')

@section('breadcrumbs')
    <strong>/</strong> <a href="{{ route('payments.index') }}">Pagos</a>
    <strong>/</strong> Seleccion de método de pago
@endsection

@section('content')
    <ul>
        {{-- Agregar métodos de pago aquí --}}
    </ul>
@endsection
