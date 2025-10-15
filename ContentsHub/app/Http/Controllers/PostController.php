<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function home()
    {
        $posts = Post::with('user')
            ->where('status', 'published')
            ->latest('published_at')
            ->take(6)
            ->get();

        return view('home', compact('posts'));
    }

    public function index()
    {
        $posts = Post::with('user')
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'status' => 'required|in:draft,published'
        ]);

        $post = Auth::user()->posts()->create([
            ...$validated,
            'published_at' => $validated['status'] === 'published' ? now() : null,
        ]);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        if ($post->status === 'draft' && $post->user_id !== Auth::id()) {
            abort(404);
        }

        return view('posts.show', [
            'post' => $post->load(['user', 'comments.user'])
        ]);
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'status' => 'required|in:draft,published'
        ]);

        // Set published_at if post is being published for the first time
        if ($validated['status'] === 'published' && !$post->published_at) {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }

    public function dashboard()
    {
        $posts = Post::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('posts.dashboard', compact('posts'));
    }
}