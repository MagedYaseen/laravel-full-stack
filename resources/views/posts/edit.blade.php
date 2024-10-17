<x-app-layout>


	<h1 class="p-4 text-center text-2xl font-extrabold text-zinc-700">Update Post {{ $post->title }}</h1>

	<div class="p-4 flex flex-col flex-wrap gap-8 justify-center">


		<form action="{{ route('posts.update', $post) }}" class="max-w-sm mx-auto" novalidate method="post"
			enctype="multipart/form-data">

			<!-- Session Token -->
			@csrf

			<!-- Method -->
			@method('put')

			<!-- Title -->
			<div class="mb-5">
				<label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
					title</label>
				<input type="text" id="title" name="title"
					class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					placeholder="Your Post Title" required value="{{ old('title') ?? $post->title  }}" />
				<small class="text-xs text-red-700">
					@error('title')
						{{ $message }}
					@enderror
				</small>
			</div>

			<!-- Thumbnail -->
			<div class="mb-5">
				<label for="thumbnail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post
					Thumbnail</label>

				<div class="mb-5">
					<img src="{{ url('storage/' . $post->thumbnail)  }}" alt="">
				</div>

				<input type="file" id="thumbnail" name="thumbnail"
					class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					required />
				<small class="text-xs text-red-700">
					@error('thumbnail')
						{{ $message }}
					@enderror
				</small>
			</div>

			<!-- Body -->
			<div class="mb-5">
				<label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
					body</label>
				<textarea id="body" name="body"
					class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					required placeholder="Your Post Content">{{ old('body') ?? $post->body }}</textarea>
				<small class="text-xs text-red-700">
					@error('body')
						{{ $message }}
					@enderror
				</small>
			</div>

			<!-- post Status -->
			<div class="mb-5">


				<!-- Post Status -->
				<label for="post_status_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post
					Status</label>
				<select id="post_status_id" name="post_status_id"
					class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

					<option value="">Select Post Status</option>

					@foreach ($post_statuses as $post_status)
						<option {{ (old('post_status_id') ?? $post->post_status_id) == $post_status->id ? 'selected' : ''}}
							value="{{ $post_status->id }}">{{ $post_status->type }}</option>
					@endforeach

				</select>

				<small class="text-xs text-red-700">
					@error('post_status_id')
						{{ $message }}
					@enderror
				</small>
			</div>

			<button class="my-4 px-3 py-1 rounded-md text-white bg-sky-600 shadow-md" type="submit">Post</button>



			@if ($errors->any())
				<ul class="text-red-600">
					@foreach ($errors->all() as $error)
						<li class="mb-2 border-b border-red-400">{{ $error }}</li>
					@endforeach
				</ul>
			@endif

		</form>



	</div>

</x-app-layout>