<x-app-layout>
	<h1 class="p-4 text-center text-5xl font-extrabold text-zinc-700">All Posts</h1>

	<div class="p-4 flex flex-col gap-8">

		<div class="p-4 flex flex-wrap gap-8 justify-center">
			@each('components.posts.card', $posts, 'post')

		</div>

		<div class="p-4">
			{{ $posts->links() }}
		</div>
	</div>

</x-app-layout>