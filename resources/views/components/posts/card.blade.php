<!-- Start of component -->
<div class="max-w-md bg-white border-2 border-gray-300 p-5 rounded-md tracking-wide shadow-lg">
	<div class="flex items-start" id="header">
		<div class="flex flex-col gap-2 items-center w-2/12">
			<div>
				<img alt="mountain" class="rounded-md border-2 border-gray-300" src="{{ url('storage/' . $post->thumbnail) }}" />
			</div>
			<span>
				{{ $post->id }}
			</span>
		</div>
		<div class="flex-1 flex flex-col ml-5 w-10/12" id="body">
			<h4 class="text-xl font-semibold mb-2" id="title">
				<a href="{{ route('posts.show', $post) }}">
					{{ $post->title }}
				</a>
			</h4>

			<div class="ms-auto font-extrabold text-xs text-sky-500">
				<i class="fa-regular fa-comment"></i>
				{{ $post->comments_count }}
			</div>

			<p class="text-gray-800 mt-2 overflow-auto" id="body">{{ $post->body }}</p>

			<div class="flex mt-5">
				<img alt="avatar" class="w-6 rounded-full border-2 border-gray-300" src="{{ url('storage/' . $post->user->profile_photo_path) }}" />
				<p class="ml-3">{{ $post->user->name }}</p>
			</div>
		</div>
	</div>
</div>
