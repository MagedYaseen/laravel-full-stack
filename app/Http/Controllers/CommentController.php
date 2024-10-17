<?php

namespace App\Http\Controllers;

use App\Mail\CommentNotificationMail;
use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();

        $user = Auth::user();

        $data['user_id'] = $user->id;



        if (Comment::create($data)) {
            /////// Send email to post owner


            $post = Post::with('user')->where('id', $request->post_id)->first();

            $owner_email = $post->user->email;

            Mail::to($owner_email)->send(new CommentNotificationMail($user->name, $post, $request->comment));


            return redirect()->back()->with('comment_saved', 'Thanks for your comment!');
        }

        return redirect()->back()->with('error', 'Cannot comment!!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
