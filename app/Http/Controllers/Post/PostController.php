<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
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
    public function showCreateForm()
    {
        return view('create-post');
    }

    public function search($term)
    {
        $posts = Post::search($term)->get();
        $posts->load('user:id,username,avatar');
        return $posts;
        //return Post::where('title', 'LIKE', '%' . $term . '%')->orWhere('body', 'LIKE', '%' . $term . '%')->with('user:id,username,avatar')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeNewPost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();

        $newPost = Post::create($incomingFields);

        return redirect("/post/{$newPost->id}")->with('success', 'New post successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function viewSinglePost(Post $post)
    {
        $ourHTML = strip_tags(Str::markdown($post->body), '<p><ul><ol><li><strong><em><h3><br><img><h1><h2>');
        $post['body'] = $ourHTML;
        return view('single-post', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function showEditForm(Post $post)
    {
        return view('edit-post', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function actuallyUpdate(Post $post, Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);

        return back()->with('success', 'Post successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Post $post)
    {
        $post->delete();

        return redirect('/profile/' . auth()->user()->username)->with('success', 'Post successfully deleted.');
    }
}
