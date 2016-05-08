@extends('layouts.lavorum')

@section('title')
@if ($post)
	{{ $post->title }}
@else
	Page does not exist
@endif
@endsection

@section('title-meta')
{{ $post->created_at }}
@endsection

@section('navbar-left')
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
				<h2><a href="{{ url('/lavorum/user/'.$post->author->username)}}">{{ $post->author->username }}</a></h2>
			</div>
			<div>
				@if ($post->created_at != $post->updated_at)
					<span class="text-muted">Updated {{ $post->updated_at->format('Y-m-d H:i') }}</span>
				@endif
			</div>
		</div>
		<div class="panel-body">
			{!! $post->content !!}
		</div>
	</div>

	@if ($comments->count() > 0)
		<hr/>
		<div class="comments">
			<ul>
				@foreach ($comments as $comment)
					<li>
						<form method="post" action="/lavorum/comment/update/{{ $comment->id }}">
							<div class="list-group" id="comment_{{ $comment->id }}">
								<div class="list-group-item">
									<div class="table2">
										<div>
											<a href="{{ url('/lavorum/user/'.$comment->author->username) }}">{{ $comment->author->username }}</a>
											//
											{{ $comment->created_at }}
										</div>
										<div>
											@if (!Auth::guest() && ($comment->user_id == Auth::user()->id || Auth::user()->is_admin()))
												<div>
													<button type="submit" class="btn btn-success btn-xs edit_btns_{{ $comment->id }}" href="{{ url('/lavorum/comment/update/'.$comment->id) }}" style="display:none;">Save</button>
													<button type="reset" class="btn btn-default btn-xs edit_btns_{{ $comment->id }}" onclick="editComment('{{ $comment->id }}','cancel')" style="display: none;">Cancel</button>
													<a class="btn btn-default btn-xs edit_btn_{{ $comment->id }}" onclick="editComment('{{ $comment->id }}','edit')">Edit</a>
													<a class="btn btn-danger btn-xs" href="{{ url('/lavorum/comment/delete/'.$comment->id) }}">Delete</a>
												</div>
											@endif
										</div>
									</div>
								</div>
								<div class="list-group-item">
									@if (!Auth::guest() && ($comment->user_id == Auth::user()->id || Auth::user()->is_admin()))
										<form>
											<input type="hidden" name="_token" value="{{ csrf_token() }}" />
											<input type="hidden" name="comment_{{ $comment->id }}" value="{{ $comment->id }}{{ old('comment_id') }}" />
											<textarea name="new_comment_{{ $comment->id }}" class="text-hidden comment_new_{{ $comment->id }}">{{ $comment->comment }}{{ old('comment') }}</textarea>
											<p class="comment_id_{{ $comment->id }}">{!! nl2br(e($comment->comment)) !!}</p>
										</form>
									@else
										<p>{!! nl2br(e($comment->comment)) !!}</p>
									@endif
								</div>
							</div>
						</form>
					</li>
				@endforeach
			</ul>
		</div>
	@endif

	<div class="comment well">
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
				<input type="reset" name="reset_comment" class="btn btn-default" value="Reset" />
			</form>
		@endif
	</div>
@else
	404 error
@endif
@endsection
