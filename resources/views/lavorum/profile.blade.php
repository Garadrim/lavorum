@extends('layouts.lavorum')

@section('title')
{{ $user->username }}
@endsection

@section('title-meta')
{{-- Latest login <b>{{ $user->updated_at->format('Y-d-m H:i') }}</b> --}}
@endsection

@section('content')
<div>
	<ul class="list-group">
		<li class="list-group-item">
			<h2>Joined {{ $user->created_at }}</h2>
		</li>
		<li class="list-group-item panel-body">
			<table class="table3">
				<tr>
					<td>Total Posts</td>
					<td> {{$posts_count}} </td>
					@if ($author && $posts_count)
						<td><a href="{{ url('/lavorum/user/all')}}">Show all</a></td>
					@endif
				</tr>
				<tr>
					<td>Published</td>
						<td>{{ $posts_active_count }}</td>
						@if ($posts_active_count)
							<td><a href="{{ url('/lavorum/user/'.$user->id.'/posts')}}">Show all</a></td>
						@endif
				</tr>
				@if ($author)
					<tr>
						<td>Drafts</td>
						<td>{{ $posts_draft_count }}</td>
						@if ($author && $posts_draft_count)
							<td><a href="{{ url('lavorum/user/drafts')}}">Show all</a></td>
						@endif
					</tr>
				@endif
			</table>
		</li>
		<li class="list-group-item">
			Total comments <h3>{{ $comments_count }}</h3>
		</li>
	</ul>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3>Latest Posts</h3>
	</div>
	<div class="panel-body">
		@if (!empty($latest_posts[0]))
			@foreach ($latest_posts as $latest_post)
				<div class="table3">
					<div>
						<div>
							<a href="{{ url('/lavorum/show/'.$latest_post->slug) }}">{{ str_limit($latest_post->title, $limit = 10, $end = '...') }}</a>
						</div>
					</div>
					<div>
						<span class="well-sm">{{ $latest_post->created_at }}</span>
					</div>
				</div>
			@endforeach
		@else
			<p>You have not written any post till now.</p>
		@endif
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading"><h3>Latest Comments</h3></div>
	<div class="list-group">
		@if(!empty($latest_comments[0]))
			@foreach($latest_comments as $latest_comment)
				<div class="list-group-item">
					<div class="table2b">
						<div>
							<a href="{{ url('/lavorum/show/'.$latest_comment->post->slug) }}">{{ str_limit($latest_comment->post->title, $limit = 10, $end = '...') }}</a>
						</div>
						<div>{{ str_limit($latest_comment->comment, $limit = 50, $end = '...') }}</div>
						<div>{{ $latest_comment->created_at }}</div>
					</div>
				</div>
			@endforeach
		@else
			<div class="list-group-item">
				<p>You have not commented till now. Your latest 5 comments will be displayed here</p>
			</div>
		@endif
	</div>
</div>
@endsection
