@extends('layouts.app')

@section('title', 'Usuarios Oneclick Normal')

@section('breadcrumbs')
    <strong>/</strong> <a href="{{ route('payments.index') }}">Pagos</a>
    <strong>/</strong> Selección de usuario
@endsection

@section('content')
    <div>
        <form action="{{ route('oneclick_normal.inscribe', ['paymentId' => $paymentId]) }}" method="post">
            <input type="text" name="username" id="username" placeholder="Nombre de usuario" autofocus>
            <input type="email" name="email" id="email" placeholder="Correo electrónico">
            <button>Crear usuario</button>
        </form>
    </div>
    @if(!$users->isEmpty())
        <ul>
            @foreach($users as $user)
                <li>
                    {{ $user->username }} ({{ $user->email }})
                    -
                    <a href="{{ route('oneclick_normal.remove', ['paymentId' => $paymentId, 'userId' => $user->id]) }}">
                        Eliminar
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
