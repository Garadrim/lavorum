@extends('layouts.app')

@section('active_home', 'active')

@section('title')
{{ Auth::user()->username }}
@endsection

@section('content')
<div class="jumbotron">
    <div class="container">
        <h1>@yield('title')</h1>
    </div>
</div>
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

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#home").addClass("active");
    });
</script>
@endsection