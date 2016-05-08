@extends('layouts.lavorum')

@section('title')
{{ $user->username }}
@endsection

@section('title-meta')
{{-- Latest login <b>{{ $user->updated_at->format('Y-d-m H:i') }}</b> --}}
Member since {{ $user->created_at }}
@endsection

@section('content')
<div>
	<h1>Profile</h1>
	<hr/>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3>Posts</h3>
	</div>
	<div class="list-group">
		<div class="list-group-item">
			<table class="table3">
				<tr>
					<td>Total Posts</td>
					<td> {{$posts_count}} </td>
					@if ($author && $posts_count)
						<td><a href="{{ url('/lavorum/user/all-posts')}}">Show all</a></td>
					@endif
				</tr>
				@if ($author)
					<tr>
						<td>Published</td>
							<td>{{ $posts_active_count }}</td>
							@if ($posts_active_count)
								<td><a href="{{ url('/lavorum/user/'.$user->username.'/posts')}}">Show all</a></td>
							@endif
					</tr>
					<tr>
						<td>Drafts</td>
						<td>{{ $posts_draft_count }}</td>
						@if ($author && $posts_draft_count)
							<td><a href="{{ url('lavorum/user/drafts')}}">Show all</a></td>
						@endif
					</tr>
				@endif
			</table>
		</div>
	</div>
	<div class="panel-heading">
		<h4>Latest</h4>
	</div>
	<div class="list-group">
		@if (!empty($posts_active_count))
			@foreach ($latest_posts as $latest_post)
				<div class="list-group-item">
					<div class="table-profile posts">
						<div>
							<div>
								<a href="{{ url('/lavorum/show/'.$latest_post->slug) }}">{{ str_limit($latest_post->title, $limit = 40, $end = '...') }}</a>
							</div>
						</div>
						<div>{{ $latest_post->created_at }}</div>
					</div>
				</div>
			@endforeach
		@else
			<div class="list-group-item">
				<p>You have not published any posts till now.</p>
			</div>
		@endif
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3>Comments</h3>
	</div>
	<div class="list-group">
		<div class="list-group-item">
			Total comments <span class="">{{ $comments_count }}</span>
		</div>
	</div>
	<div class="panel-heading">
		<h4>Latest</h4>
	</div>
	<div class="list-group">
		@if(!empty($latest_comments[0]))
			@foreach($latest_comments as $latest_comment)
				<div class="list-group-item">
					<div class="table-profile comments">
						<div>
							<a href="{{ url('/lavorum/show/'.$latest_comment->post->slug) }}#comment_{{ $latest_comment->id }}">{{ str_limit($latest_comment->post->title, $limit = 10, $end = '...') }}</a>
						</div>
						<div>{{ str_limit($latest_comment->comment, $limit = 50, $end = '...') }}</div>
						<div>{{ $latest_comment->created_at }}</div>
					</div>
				</div>
			@endforeach
		@else
			<div class="list-group-item">
				<p>Your latest 5 comments will be displayed here, but you have not made any comments yet...</p>
			</div>
		@endif
	</div>
</div>
@endsection
