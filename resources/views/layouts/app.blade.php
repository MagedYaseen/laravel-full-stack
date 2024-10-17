<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="{{ csrf_token() }}" name="csrf-token">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Fonts -->
	<link href="https://fonts.bunny.net" rel="preconnect">
	<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

	<!-- Scripts -->
	@vite(['resources/css/app.css', 'resources/js/app.js'])

	<!-- Styles -->
	@livewireStyles
</head>

<body class="font-sans antialiased">

	<!-- Sessions -->

	@if (session('error'))
		<div class="p-3 rounded-md text-red-700 bg-red-100 shadow-md fixed top-0 left-0 w-full opacity-60">
			{{ session('error') }}
		</div>
	@endif

	@if (session('success'))
		<div class="p-3 rounded-md text-green-700 bg-green-100 shadow-md fixed top-0 left-0 w-full opacity-60">
			{{ session('success') }}
		</div>
	@endif


	<x-banner />

	<div class="min-h-screen bg-gray-100">
		@livewire('navigation-menu')

		<!-- Page Heading -->
		@if (isset($header))
			<header class="bg-white shadow">
				<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
					{{ $header }}
				</div>
			</header>
		@endif

		<!-- Page Content -->
		<main>
			{{ $slot }}
		</main>
	</div>

	@stack('modals')

	@livewireScripts
</body>

</html>