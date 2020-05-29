@extends('layouts.autosend')

@section('form')
    <form action="{{ $response->urlRedirection }}" method="post">
        <input type="hidden" name="token_ws" value="{{ $token }}">
    </form>
@endsection
