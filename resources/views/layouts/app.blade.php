<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

	<!-- Usando Vite -->
	@vite(['resources/js/app.js'])
</head>

<body>
	<div id="app">

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                
                <ul class="navbar-nav me-auto">
                    <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                        <div class="logo_laravel">DELIVEBOO</div>
                    </a>

                    <a class="navbar-brand d-flex align-items-center" href="{{ url('http://localhost:5173/') }}">
                        <div class="logo_laravel">Front-office</div>
                    </a>
                </ul>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
					aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
					<!-- Left Side Of Navbar -->
					<ul class="navbar-nav me-auto">
						{{-- <li class="nav-item">
							<a class="nav-link" href="{{ url('/') }}">{{ __('Home') }}</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="{{ route('dishes.create') }}">{{ __('Crea piatto') }}</a>
						</li> --}}
					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="navbar-nav ml-auto">
						<!-- Authentication Links -->
						@guest
							<li class="nav-item">
								<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
							</li>
							@if (Route::has('register'))
								{{-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li> --}}
							@endif
						@else
							<li class="nav-item dropdown">
								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
									aria-haspopup="true" aria-expanded="false" v-pre>
									{{ Auth::user()->name }}
								</a>

								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="{{ url('home') }}">{{ __('Il Mio Ristorante') }}</a>
									<a class="dropdown-item" href="{{ route('profile.destroy') }}">{{ __('Elimina profilo') }}</a>
									<a class="dropdown-item" href="{{ route('logout') }}"
										onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
										{{ __('Logout') }}
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

		<main class="container">
			@yield('content')
			@yield('modals')
		</main>
		@yield('scripts')
	</div>
</body>

</html>
