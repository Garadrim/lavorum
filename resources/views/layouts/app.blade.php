<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>@yield('title') | Laravel</title>

		<!-- Fonts -->
		<link rel="stylesheet" href="{{ asset('/css/font-awesome.css') }}">
		<link rel="stylesheet" href="{{ asset('/css/fonts.css') }}">

		<!-- Styles -->
		<link rel="stylesheet" href="{{ asset('/css/bootstrap-yeti.css') }}">
		{{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
		<style>
			body {
			width:100%;
			min-height:100%;
			padding-top:52px;
			}
			section {
			min-height:100%;
			}

			.fa-btn {
			margin-right: 6px;
			}
			.big {
			font-size:90px;
			text-align:center;
			font-weight:100;
			font-family:'Lato';
			}
			.footer {
			position:fixed;
			bottom:0;
			left:0;
			right:0;
			padding:10px;
			}
		</style>

	</head>
	<body id="app-layout">
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">

					<!-- Collapsed Hamburger -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<!-- Branding Image -->
					<a class="navbar-brand" href="{{ url('/') }}">Laravel</a>
				</div>

				<div class="collapse navbar-collapse" id="app-navbar-collapse">
					<!-- Left Side Of Navbar -->
					<ul class="nav navbar-nav">
						<li class="@yield('active_home')"><a href="{{ url('/home') }}">Home</a></li>
					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="nav navbar-nav navbar-right">
						<!-- Authentication Links -->
						@if (Auth::guest())
						<li><a href="{{ url('/login') }}">Login</a></li>
						<li><a href="{{ url('/register') }}">Register</a></li>
						@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user"></i> {{ Auth::user()->username }} <span class="caret"></span></a>

							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
							</ul>
						</li>
						@endif
						</ul>
				</div>
			</div>
		</nav>

		<section>
			<div class="jumbotron">
				<div class="container">
					<h1>@yield('title')</h1>
					@yield('title-meta')
				</div>
			</div>
			@yield('content')
		</section>

		<footer class="footer">
			<div class="container">
				<div>
					<span id="footer_me"></span><span id="footer_year" class="text-muted"></span>
				</div>
			</div>
		</footer>

		<!-- JavaScripts -->
		<script type="text/javascript" src="{{ asset('/js/jquery-2_1_1.js') }}"></script>
		<script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('/js/script.js') }}"></script>
		{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
	</body>
</html>
