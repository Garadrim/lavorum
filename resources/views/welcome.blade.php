@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="big">Laravel 5</div>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		$("body").addClass("welcome");
	});
</script>
@endsection