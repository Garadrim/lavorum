@extends('layouts.lavorum')

@section('title')
	@if ($post)
		{{ $post->title }}
	@else
		Page does not exist
	@endif
@endsection

@section('title-meta')
	<div>{{ $post->created_at->format('H:i // l dS F Y') }}</div>
@endsection

@section('navbar-extra')
	@if (!Auth::guest() && ($post->user_id == Auth::user()->id || Auth::user()->is_admin()))
		<ul class="nav navbar-nav">
			<li>
				<a href="{{ url('/lavorum/post/edit/'.$post->slug) }}">Edit post</a>
			</li>
		</ul>
	@endif
@endsection

@section('content')

	@if ($post)
		<div class="panel panel-default">
			<div class="panel-heading table2">
				<div>
					<a href="{{ url('/lavorum/user/'.$post->user_id)}}">{{ $post->author->username }}</a>
				</div>
				<div>
					@if (!($post->created_at == $post->updated_at))
						<span class="text-muted">Updated: {{ $post->updated_at->format('Y-m-d H:i') }}</span>
					@endif
				</div>
			</div>
			<div class="panel-body">
				{!! $post->content !!}
			</div>
		</div>

		@if ($comments->count() > 0)
			<div class="comments">
				<ul>
					@foreach ($comments as $comment)
						<li>
							<div class="list-group">
								<div class="list-group-item">
									<div class="table2">
										<div>
											{{ $comment->author->username }}
											//
											{{ $comment->created_at }}
										</div>
										<div>
											@if (!Auth::guest() && ($comment->user_id == Auth::user()->id || Auth::user()->is_admin()))
												<div>
													{{-- <a class="btn btn-default btn-xs" href="{{ url('/lavorum/comment/edit/'.$comment->id) }}">Edit</a> --}}
													<a class="btn btn-danger btn-xs" href="{{ url('/lavorum/comment/delete/'.$comment->id) }}">Delete</a>
												</div>
											@endif
										</div>
									</div>
								</div>
								<div class="list-group-item">
									<p>{{ $comment->comment }}</p>
								</div>
							</div>
						</li>
					@endforeach
				</ul>
			</div>
		@endif

		<div class="comment">
			@if (Auth::guest())
				<div>
					<h3>Login to post a comment</h3>
				</div>
			@else
				<div class="comment-heading">
					<div>
						<h3>Post a comment</h3>
					</div>
				</div>
				<form method="post" action="{{ url('/lavorum/comment/add') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<input type="hidden" name="post_id" value="{{ $post->id }}" />
					<input type="hidden" name="slug" value="{{ $post->slug }}" />
					<div class="form-group">
						<textarea name="comment" class="form-control" placeholder="Enter comment here" required></textarea>
					</div>
					<input type="submit" name="post_comment" class="btn btn-success" value="Post" />
					<input type="reset" name="reset_comment" class="btn btn-default" value="Cancel" />
				</form>
			@endif
		</div>
	@else
		404 error
	@endif
	
@endsection