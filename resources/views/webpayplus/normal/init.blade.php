@extends('layouts.autosend')

@section('form')
    <form action="{{ $response->url }}" method="post">
        <input type="hidden" name="token_ws" value="{{ $response->token }}">
    </form>
@endsection
