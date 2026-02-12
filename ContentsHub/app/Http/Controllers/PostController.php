<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\PostService;
use App\Jobs\CreatePostJob;


class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

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

        // Dispatch the queued job
        CreatePostJob::dispatch(Auth::user(), $validated);

        return redirect()->route('posts.index')
            ->with('success', 'Post creation is being processed.');
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

        $this->postService->updatePost($post, $validated);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $this->postService->deletePost($post);

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }

    public function dashboard()
    {
        $posts = Post::where('user_id', Auth::id())
            //->latest()
            ->paginate(10);

        return view('posts.dashboard', compact('posts'));
    }
}