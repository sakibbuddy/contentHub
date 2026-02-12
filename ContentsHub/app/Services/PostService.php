<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class PostService
{
    /**
     * Create a new post for a user.
     */
    public function createPost(User $user, array $data): Post
    {
        $postData = Arr::only($data, ['title', 'content', 'status']);
        $postData['published_at'] = ($postData['status'] ?? null) === 'published' ? now() : null;
        return $user->posts()->create($postData);
    }

    /**
     * Update an existing post.
     */
    public function updatePost(Post $post, array $data): Post
    {
        $postData = Arr::only($data, ['title', 'content', 'status']);
        if (($postData['status'] ?? null) === 'published' && !$post->published_at) {
            $postData['published_at'] = now();
        }
        $post->update($postData);
        return $post;
    }

    /**
     * Delete a post.
     */
    public function deletePost(Post $post): void
    {
        $post->delete();
    }
}
