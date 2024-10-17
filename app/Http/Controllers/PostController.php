<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\PostStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        // $posts = Cache::remember('posts_' . Auth::user()->id, 60, function () {
        //     return Post::with(['user', 'postStatus', 'reactions'])
        //         ->withCount('comments')->limit(20)->get();
        // });




        $posts = Post::with(['user', 'postStatus', 'reactions'])
            ->withCount('comments')->limit(20)->paginate(50);




        // return response($posts);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Policy Middleware
        Gate::authorize('showForm', Post::class);


        $post_statuses = PostStatus::orderBy('type')->get();


        // return view('posts.create', ['post_statuses' => $post_statuses]);
        return view('posts.create', compact('post_statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {


        $thumb_path = $request->file('thumbnail')->store('posts');

        if (!$thumb_path)
            return redirect()->back()->with('error', 'Cannot store the post thumbnail');


        $data = $request->validated();
        $data['thumbnail'] = $thumb_path;
        $data['user_id'] = Auth::user()->id;

        $post = Post::create($data);

        if (!$post)
            redirect()->back()->with('error', 'Cannot create the post');


        return redirect()->route('posts.show', $post)->with('success', 'Post added successfully.');


    }

    /**
     * Display the specified resource.
     */
    public function show($post)
    {

        // return $post;
        // $post = Post::where('id', $post->id)->first();
        $post = Post::where('id', $post)
            ->with('comments.user')
            ->withCount('comments');

        // dd($post);
        $post = $post->firstOrFail();

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Policy Middleware
        // Gate::authorize('update', $post);


        // Redirect to posts page if the user do not own the post
        if (Auth::user()->id !== $post->user_id) {
            return redirect()->route('posts.index');
        }


        $post_statuses = PostStatus::orderBy('type')->get();


        // return view('posts.create', ['post_statuses' => $post_statuses]);
        return view('posts.edit', compact('post_statuses', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

        // Policy Middleware
        Gate::authorize('update', $post);

        $data = $request->validated();

        // If there are a new thumbnail uploaded
        if ($request->file('thumbnail')) {

            // Delete old thumbnail
            if (!Storage::delete($post->thumbnail))
                return redirect()->back()->with('error', 'Cannot delte the post old thumbnail');


            // Add new thumbnail
            $thumb_path = $request->file('thumbnail')->store('posts');

            if (!$thumb_path)
                return redirect()->back()->with('error', 'Cannot update the post thumbnail');

            // Update the data with new thumbnail path
            $data['thumbnail'] = $thumb_path;
        }



        $updated = $post->update($data);

        return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // return $post;
        if ($post->delete())
            return redirect()->route('posts.index')->with('success', "Post $post->title deleted successfully!");

        return redirect()->back()->with('error', 'Post not deleted!!!');
    }
    public function deleted()
    {
        return Post::onlyTrashed()->get();
    }

    public function restore($post)
    {
        $found_post = Post::onlyTrashed()->find($post);

        if ($found_post) {
            return $found_post->restore();
        } else {
            return false;
        }
    }
}
