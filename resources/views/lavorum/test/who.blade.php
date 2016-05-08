@extends('layouts.lavorum')

@section('title')
{{ $user->username }}
@endsection

@section('content')
{{ $user->id }}
@endsection
