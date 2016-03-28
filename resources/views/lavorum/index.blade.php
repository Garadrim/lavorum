@extends('layouts.lavorum')

@section('title', 'Lavorum')

@section('title-meta')
<div>A forum. For you, by me.</div>
@endsection

@section('content')
@if ($posts->count() < 1)
	<div>There is no post till now. Login and write a new post now!</div>
@else
	<div>
		@foreach ($posts as $post)
			<div class="list-group">
				<div class="table">
					<div>
						<div class="list-group-item">
							<div class="table2">
								<div>
									<div>
										<b><a href="{{ url('/lavorum/show/'.$post->slug) }}">{{ str_limit($post->title, $limit = 100, $end = '...') }}</a></b>
									</div>
								</div>
								<div>
									<a href="{{ url('/lavorum/user/'.$post->user_id)}}">{{ $post->author->username }}</a>
								</div>
								<div>
									<span>{{ $post->created_at }}</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		<div class="paginator">
			{!! $posts->render() !!}
		</div>
	</div>
@endif
@endsection
