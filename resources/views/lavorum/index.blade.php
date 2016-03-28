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
						<div class="list-group-item">
							<div>
								<a href="{{ url('/lavorum/user/'.$post->user_id)}}">{{ $post->author->username }}</a>
							</div>
						</div>
						<div>
							<div class="list-group-item">
								<div class="table2">
									<div>
										<div>
											<b><a href="{{ url('/lavorum/view/'.$post->slug) }}">{{ str_limit($post->title, $limit = 100, $end = '...') }}</a></b>
										</div>
									</div>
									@if (!Auth::guest() && ($post->user_id == Auth::user()->id || Auth::user()->is_admin()))
										<div>
											@if ($post->active == '1')
												<a class="btn btn-default btn-xs" href="{{ url('/lavorum/post/edit/'.$post->slug) }}">Edit</a>
											@else
												<a class="btn btn-default btn-xs" href="{{ url('/lavorum/post/edit/'.$post->slug) }}">Edit</a>
											@endif
										</div>
									@endif
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