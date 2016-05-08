@extends('layouts.app')

@section('title', '404')

@section('content')
<div class="jumbotron">
    <div class="container">
        <h1>@yield('title')</h1>
    </div>
</div>
<div class="container">
	Nope, the page you're looking for doesn't exist.
</div>
@endsection