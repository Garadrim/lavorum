@extends('layouts.app')

@section('title','Home')
@section('title-meta')
<span>You are logged in!</span>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Websites</div>
				<div class="panel-body">
					<a href="/lavorum">Lavorum - A forum</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
