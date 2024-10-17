<!DOCTYPE html>
<html lang="en">

@include('includes.head')

<body>

	<!-- Top Navbar -->
	@include('includes.top-navbar')

	<!-- Hero Section -->
	<section class="bg-center bg-no-repeat bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/conference.jpg')] bg-gray-700 bg-blend-multiply">
		<div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
			<h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">We
				invest in the community</h1>
			<p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">Here at Flowbite we focus on
				markets where technology, innovation, and capital can unlock long-term value and drive economic growth.
			</p>
			 
		</div>
	</section>

	<!-- Pages Content -->

	@yield('content')

	<!-- Main Footer -->
	@include('includes.main-footer')

</body>

</html>
