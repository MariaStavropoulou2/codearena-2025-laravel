<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(?User $user = null)
    {
        $posts = Post::whereNotNull('published_at')
            ->whereNotNull('image')
            ->when($user, function ($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->orderByDesc('promoted')
            ->orderByDesc('published_at')
            ->paginate(9);

        $authors = User::whereHas('posts', function ($query) {
            $query->whereNotNull('published_at');
        })->get();

        return view('posts.index', compact('posts', 'authors'));
    }


    public function show(Post $post)
{
    if (!$post->published_at || $post->published_at->isFuture()) {
        abort(404);
    }

    $post->load(['comments' => fn($query) => $query->latest()]);

    return view('posts.show', compact('post'));
}




    public function promoted()
    {
        $posts = Post::whereNotNull('published_at')
            ->where('promoted', true)
            ->get();

        return view('posts.promoted', compact('posts'));
    }

    public function comment(Request $request, Post $post)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post->comments()->create($validated);

        return redirect()->route('post', $post);
    }





}



