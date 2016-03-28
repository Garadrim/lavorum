@extends('layouts.lavorum')

@section('title', 'Edit post')

@section('navbar-extra')
	<ul class="nav navbar-nav">
		<li class="active">
			<a href="{{ url('/lavorum/view/'.$post->slug) }}">{{ $post->title }}</a>
		</li>
	</ul>
@endsection

@section('content')

	<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/tinymce-init.js') }}"></script>

	<form method="post" action="{{ url('/lavorum/post/update') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
		<input type="hidden" name="post_id" value="{{ $post->id }}{{ old('post_id') }}" />
		<div class="form-group">
			<input type="text" name="title" class="form-control" placeholder="Enter title here" maxlength="100" value="@if(!old('title')){{$post->title}}@endif{{ old('title') }}" required />
		</div>
		<div class="form-group">
			<textarea name="content" class="form-control textarea">@if(!old('content')){!! $post->content !!}@endif{!! old('content') !!}</textarea>
		</div>
		<div class="pull-left">
			@if ($post->active == '1')
				<input type="submit" name='publish' class="btn btn-success" value="Update" />
			@else
				<input type="submit" name='publish' class="btn btn-success" value="Publish"/>
			@endif
			<input type="submit" name='save' class="btn btn-default" value="Save as draft" />
		</div>
		<div class="pull-right">
			<a href="{{ url('/lavorum/post/delete/'.$post->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Delete</a>
		</div>
	</form>

@endsection