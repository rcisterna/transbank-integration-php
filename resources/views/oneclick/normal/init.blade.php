@extends('layouts.autosend')

@section('form')
    <form action="{{ $response->urlWebpay }}" method="post">
        <input type="hidden" name="TBK_TOKEN" value="{{ $response->token }}">
    </form>
@endsection
