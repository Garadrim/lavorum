<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="noindex, nofollow" />
		<meta name="description" content="Made by Fredrik">
		<meta name="author" content="Fredrik" />
		<title>@yield('title') | Lavorum</title>
		<link rel="stylesheet" href="{{ asset('/css/bootstrap-cosmo.css') }}">
		<link rel="stylesheet" href="{{ asset('/css/font-awesome.css') }}">
		<link rel="stylesheet" href="{{ asset('/css/fonts.css') }}">
		<link rel="stylesheet" href="{{ asset('/css/style.css') }}">
	</head>
	<body id="lavorum">

		<nav class="navbar navbar-default navbar-fixed-top" id="header">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{{ url('/lavorum') }}">Lavorum</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					@yield('navbar-left')
					<ul class="nav navbar-nav navbar-right">
						@if (Auth::guest())
							<li>
								<a href="{{ url('/auth/login') }}">Login</a>
							</li>
							<li>
								<a href="{{ url('/auth/register') }}">Register</a>
							</li>
						@else
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user"></i> {{ Auth::user()->username }} <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									@if (Auth::user()->can_post())
										<li>
											<a href="{{ url('/lavorum/post/create') }}">Create a post</a>
										</li>
										<li>
											<a href="{{ url('/lavorum/user/'.Auth::user()->username.'/posts') }}">My posts</a>
										</li>
									@endif
									<li>
										<a href="{{ url('/lavorum/user/'.Auth::user()->username) }}">My profile</a>
									</li>
									<li>
										<a href="{{ url('/logout') }}"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
									</li>
								</ul>
							</li>
						@endif
					</ul>
				</div>
			</div>
		</nav>

		<section>

			<div id="content">

				@if (Session::has('message'))
					<div class="flash error alert-info">
						<div class="container-fluid">
							<p class="panel-body">
								{{ session::get('message') }}
							</p>
						</div>
					</div>
				@endif
				@if ($errors->any())
					<div class='flash error alert-danger'>
						<div class="container-fluid">
							@foreach ( $errors->all() as $error )
								<li>
									{{ $error }}
								</li>
							@endforeach
						</div>
					</div>
				@endif

				<div class="jumbotron">
					<div class="container">
						<h1>@yield('title')</h1>
						@yield('title-meta')
					</div>
				</div>

				<div class="container">
					<div>
						@yield('content')
					</div>
				</div>

			</div>

		</section>

		<footer class="footer" id="footer">
			<div class="jumbotron">
				<div class="container-fluid">
					<div class="footer_main">
						<a href="https://github.com/Garadrim/lavorum"><i class="fa fa-github fa-2x"></i></a>
						<span id="footer_me"></span>
					</div>
					<div id="footer_year"></div>
				</div>
			</div>
		</footer>

		<script type="text/javascript" src="{{ asset('/js/jquery-2_1_1.js') }}"></script>
		<script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('/js/script.js') }}"></script>
		
	</body>
</html>