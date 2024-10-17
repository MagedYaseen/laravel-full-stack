<nav class="bg-white border-gray-200">
	<div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
		<a class="flex items-center space-x-3 rtl:space-x-reverse" href="https://flowbite.com/">
			<img alt="Flowbite Logo" class="h-8" src="https://flowbite.com/docs/images/logo.svg" />
			<span class="self-center text-2xl font-semibold whitespace-nowrap">Flowbite</span>
		</a>
		<button aria-controls="navbar-default" aria-expanded="false" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" data-collapse-toggle="navbar-default" type="button">
			<span class="sr-only">Open main menu</span>
			<svg aria-hidden="true" class="w-5 h-5" fill="none" viewBox="0 0 17 14" xmlns="http://www.w3.org/2000/svg">
				<path d="M1 1h15M1 7h15M1 13h15" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" />
			</svg>
		</button>
		<div class="hidden w-full md:block md:w-auto" id="navbar-default">
			<ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white md:dark:bg-gray-900">
				<li>
					<a aria-current="page" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" href="/">Home</a>
				</li>
				<li>
					<a class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent" href="{{ route('about') }}">About</a>
				</li>
				<li>
					<a class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent" href="{{ route('posts.index') }}">Posts</a>
				</li>
				<li>
					<a class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent" href="#">Users</a>
				</li>
				<li>
					<a class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent" href="#">Contact
						us</a>
				</li>
			</ul>
		</div>

		{{-- Authentication --}}
		<div class="flex gap-3">
			@auth
				<form action="{{ route('logout') }}" method="POST" x-data>
					@csrf
					<button class="text-red-700 border border-red-700 px-3 py-1 rounded-lg hover:text-white hover:bg-red-700">
						{{ __('Log Out') }}
					</button>
				</form>
			@else
				<a class="text-green-700 border border-green-700 px-3 py-1 rounded-lg hover:text-white hover:bg-green-700" href="{{ route('login') }}">
					Login
				</a>

				@if (Route::has('register'))
					<a class="text-sky-700 border border-sky-700 px-3 py-1 rounded-lg hover:text-white hover:bg-sky-700" href="{{ route('register') }}">
						Register
					</a>
				@endif
			@endauth
		</div>
	</div>
</nav>
