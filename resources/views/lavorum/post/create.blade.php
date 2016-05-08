@extends('layouts.lavorum')

@section('title', 'New post')

@section('content')
<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/tinymce-init.js') }}"></script>

<form method="post" action="{{ url('/lavorum/post/create') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
	<div class="form-group">
		<input type="text" name="title" class="form-control" placeholder="Enter title here" maxlength="100" value="{{ old('title') }}" required />
	</div>
	<div class="form-group">
		<textarea name="content" rows="8" class="form-control textarea">{{ old('content') }}</textarea>
	</div>
	<input type="submit" name="publish" class="btn btn-success" value="Publish" />
	<input type="submit" name="save" class="btn btn-default" value="Save as draft" />
</form>
@endsection
