@extends('layouts.lavorum')

@section('title')
{{ $title }}
@endsection

@section('title-meta')
{{ $meta }}
@endsection

@section('content')
@if ($posts->count() < 1)
	<div><h2><span class="text-muted">No posts?</span> Login and write one!</h2></div>
@else
	<table class="table table-hover table-posts">
		<thead>
			<tr>
				<th class="post">Post</th>
				<th class="reply">Reply</th>
				<th class="author">Author</th>
				<th class="date">Date</th>
			</tr>
		</thead>
		<tbody>
		@foreach ($posts as $post)
			<tr>
				<td class="post">
					<div>
						<b><a href="{{ url('/lavorum/show/'.$post->slug) }}">{{ str_limit($post->title, $limit = 100, $end = '...') }}</a></b>
					</div>
				</td>
				<td class="reply">
					@if ($post->comments->count() > 0)
						<span class="text-muted">{{ $post->comments->count() }}</span>
					@endif
				</td>
				<td class="author">
					<a href="{{ url('/lavorum/user/'.$post->author->username)}}">{{ $post->author->username }}</a>
				</td>
				<td class="date">
					<span>{{ $post->created_at }}</span>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>

	<div>
		<div class="paginator">
			{!! $posts->render() !!}
		</div>
	</div>
@endif
@endsection
