@props(['post'])

<article class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6 border border-gray-200 dark:border-gray-700">
    <div class="flex justify-between items-start">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 hover:text-blue-600 dark:hover:text-blue-400">
                <a href="{{ route('posts.show', $post) }}">
                    {{ $post->title }}
                </a>
            </h2>
            <div class="flex items-center mt-2 text-gray-600 dark:text-gray-400">
                <span>By {{ $post->user->name }}</span>
                <span class="mx-2">•</span>
                <span>{{ $post->published_at?->diffForHumans() ?? 'Draft' }}</span>
            </div>
        </div>
        @if(auth()->id() === $post->user_id)
            <div class="flex space-x-2">
                <a href="{{ route('posts.edit', $post) }}" 
                   class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                    Edit
                </a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" 
                      onsubmit="return confirm('Are you sure you want to delete this post?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
                        Delete
                    </button>
                </form>
            </div>
        @endif
    </div>

    <div class="mt-4 prose dark:prose-invert max-w-none">
        {{ Str::limit(strip_tags($post->content), 200) }}
    </div>

    <div class="mt-4 flex items-center justify-between text-sm text-gray-600 dark:text-gray-400">
        <div class="flex items-center space-x-4">
            <span>{{ $post->comments_count ?? $post->comments->count() }} comments</span>
        </div>
        <a href="{{ route('posts.show', $post) }}" 
           class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
            Read more →
        </a>
    </div>
</article>