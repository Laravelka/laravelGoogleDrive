<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Scripts -->
	<script>
		window.baseUrl = '{{ config('app.url') }}';
		window.token = '{{ Auth::user() ? Auth::user()->api_token : null }}';
		// eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZGUxNWQwMzk3MWNiODczYTY1MDIxMTEwNTM1MTkyYjg0YmE4MDFmY2ZjNmExYWIzNzEyZTc1NDM0NzhmMzVkMzFhMGM5MzFjZDBjYjhiNmUiLCJpYXQiOjE2MTk4NzQ3MDcuMzg0NzY1LCJuYmYiOjE2MTk4NzQ3MDcuMzg0NzY1LCJleHAiOjE2NTE0MTA3MDcuMzE1NDI5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.z0-96uakfcaXBtImHZNNFZ2bFcRFYf_zkkF1rE2q1w1PhQ7WQC0WHuzz7jZKCa-LlkQSGHXXmuxnfgmZVVtfOQjCo2DL4Mk_SlbK7VM4ndb1b2I4G6VPwyB34bIAsCpsX_Q9U25Y1mNdMM-27mFdq-V8rNVe712Iy6M7e80_iNt2oHlkJyw6vwnaBzLG9HHd45iCpzJWjctddKkyX_jr_CvaMeb2r6Zdx_jdeLGRI4yIl7S-1dWAKxfdxqQScT4ymYrtV3V0ErG89TTe8OJrUaAiexaKHvmlAXJCBZ7vGkeNQe07reT0uPHvpvmmOM7Q8RlQLZ9MAoI1AHmi1ef3HLqEtsbrwM6XZUdES0h8feqALnuUAzzop6-5_tuy8SAvjr6pxug-1knMJ5FnZ08-NzblXKT7by2JBZ06VRaGHF2nSqyQ5JEmngUbJfcFf3U7FFepay93Bjfjgw8q1zpHKpymfQF3BN0qewR_9BwduL-_gnDAlSgbn5hJXT_BmvVYK1dOcTQes8Xhw14uhlvUin7zOSZr-6t7iDXdSRjrwpM3kp_v-JW5RgPmnOHf1egXbQtGf-l3mjRBh4_fig9T_BLPelYvrV4PtFJ57drHi6KKk89mubJ0-aMHx1iF11-niHd5EvWyraDhkQ8bhVW0TrnCNhVFXiGN9csf_T0JMh0
	</script>
	<script src="{{ mix('js/app.js') }}" defer></script>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

	<!-- Styles -->
	<link href="{{ mix('css/app.css') }}" rel="stylesheet">

	<!-- Icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
</head>
<body>
	<div id="app">
		<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
			<div class="container">
				<a class="navbar-brand" href="{{ url('/') }}">
					{{ config('app.name', 'Laravel') }}
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Left Side Of Navbar -->
					<ul class="navbar-nav mr-auto">

					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="navbar-nav ml-auto">
						<!-- Authentication Links -->
						@guest
							@if (Route::has('login'))
								<li class="nav-item">
									<a class="nav-link" href="{{ route('login') }}">{{ __('Вход') }}</a>
								</li>
							@endif
							
							@if (Route::has('register'))
								<li class="nav-item">
									<a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
								</li>
							@endif
						@else
							<li class="nav-item dropdown">
								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									{{ Auth::user()->name }}
								</a>

								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="{{ route('logout') }}"
									   onclick="event.preventDefault();
													 document.getElementById('logout-form').submit();">
										<i class="bi bi-box-arrow-in-right"></i> {{ __('выход') }}
									</a>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
										@csrf
									</form>
								</div>
							</li>
						@endguest
					</ul>
				</div>
			</div>
		</nav>

		<main class="py-4">
			@yield('content')
		</main>
	</div>
</body>
</html>
