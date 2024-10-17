<x-app-layout>

	<main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white antialiased">
		<div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
			<article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue">

				{{-- Post User and Title --}}
				<header class="mb-4 lg:mb-6 not-format">
					<address class="flex items-center mb-6 not-italic">
						<div class="inline-flex items-center mr-3 text-sm text-gray-900">
							<img alt="{{ $post->user->name }}" class="mr-4 w-16 h-16 rounded-full"
								src="{{ url('storage/' . $post->user->profile_photo_path) }}">
							<div>
								<a class="text-xl font-bold text-gray-900" href="#"
									rel="author">{{ $post->user->name }}</a>

								<p class="text-base text-gray-500"><time datetime="2022-02-08" pubdate
										title="February 8th, 2022">Member Since {{ $post->user->created_at }}</time></p>
							</div>
						</div>
					</address>

					<!-- Post Title -->
					<div class="mb-4 lg:mb-6  flex gap-2 items-center">

						<h1 class="text-3xl font-extrabold leading-tight text-gray-900 lg:text-4xl">
							{{ $post->title }}
						</h1>

						@if (Auth::user()->id === $post->user_id)
							<a href="{{ route('posts.edit', $post) }}"
								class="text-white bg-sky-600 px-2 py-1 rounded-sm">Edit</a>
						@endif
					</div>

					<img src="{{ url('storage/' . $post->thumbnail) }}" alt="">

				</header>


				{{-- Post Content --}}
				<div>
					{{ $post->body }}
				</div>

				<!-- Delete the post -->
				@if (Auth::user()->id === $post->user_id)
					<div>
						<form method="post" action="{{ route('posts.destroy', $post) }}">
							@csrf
							@method('delete')

							<button class="text-red-800">Delete</button>
						</form>
					</div>
				@endif

				{{-- Discussion --}}
				<section class="not-format">
					<div class="flex justify-between items-center mb-6">
						<h2 class="text-lg lg:text-2xl font-bold text-gray-900">Discussion ({{ $post->comments_count }})
						</h2>
					</div>

					{{-- Add Comment --}}
					@if (array_intersect(['admin', 'comment.create'], explode(',', Auth::user()->roles)))

						@auth
							<form method="post" action="{{ route('comments.store') }}" class="mb-6">

								@csrf

								<input type="hidden" value="{{ $post->id }}" name="post_id">

								<div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200">
									<label class="sr-only" for="comment">Your comment</label>
									<textarea class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0" id="comment"
										name="comment" placeholder="Write a comment..." required
										rows="6">{{ old('comment') }}</textarea>
								</div>

								@if ($errors->any())
									@foreach ($errors->all() as $error)
										<p class="text-red-600">{{ $error }}</p>
									@endforeach
								@endif

								@if (session('comment_saved'))
									<div>
										<small class="text-green-800">{{ session('comment_saved') }}</small>
									</div>
								@endif

								<button
									class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-sky-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800"
									type="submit">
									Post comment
								</button>
							</form>
						@endauth
					@endif

					{{-- Comments --}}
					@foreach ($post->comments as $comment)
						<article class="p-6 mb-6 text-base bg-white rounded-lg">
							<footer class="flex justify-between items-center mb-2">
								<div class="flex items-center">
									<span
										class="w-5 h-5 flex justify-center items-center text-sky-700 rounded-full  bg-sky-300">{{ $loop->iteration }}</span>
									<p class="inline-flex items-center mr-3 font-semibold text-sm text-gray-900"><img
											alt="Michael Gough" class="mr-2 w-6 h-6 rounded-full"
											src="{{ url('storage/' . $comment->user->profile_photo_path) }}">{{ $comment->user->name }}
									</p>
									<p class="text-sm text-gray-600"><time datetime="2022-02-08" pubdate
											title="February 8th, 2022">{{ $comment->created_at->format('M d, Y - H:i') }}</time>
									</p>
								</div>

								{{-- Comment Actions --}}
								@auth
									<button
										class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
										data-dropdown-toggle="dropdownComment1" id="dropdownComment1Button" type="button">
										<i class="fa-solid fa-ellipsis"></i>
										<span class="sr-only">Comment settings</span>
									</button>
									<!-- Dropdown menu -->
									<div class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow"
										id="dropdownComment1">
										<ul aria-labelledby="dropdownMenuIconHorizontalButton"
											class="py-1 text-sm text-gray-700">
											<li>
												<a class="block py-2 px-4 hover:bg-gray-100" href="#">Edit</a>
											</li>
											<li>
												<a class="block py-2 px-4 hover:bg-gray-100" href="#">Remove</a>
											</li>
											<li>
												<a class="block py-2 px-4 hover:bg-gray-100" href="#">Report</a>
											</li>
										</ul>
									</div>
								@endauth

							</footer>
							{{-- Comment --}}
							<div>{{ $comment->comment }}</div>
							<div class="flex items-center mt-4 space-x-4">
								<button class="flex gap-2 items-center font-medium text-sm text-gray-500 hover:underline"
									type="button">
									<i class="fa-regular fa-message"></i>
									Reply
								</button>
							</div>
						</article>
					@endforeach
				</section>
			</article>
		</div>
	</main>

</x-app-layout>