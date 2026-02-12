<x-content-layout>
    <x-slot name="title">{{ $post->title }}</x-slot>

    <article class="max-w-4xl mx-auto">
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                            {{ $post->user->initials() }}
                        </div>
                    </div>
                    <div>
                        <div class="font-medium">{{ $post->user->name }}</div>
                        <div class="text-gray-500">
                            {{ $post->published_at?->format('F j, Y') ?? 'Draft' }}
                        </div>
                    </div>
                </div>

                @if(auth()->id() === $post->user_id)
                    <div class="flex space-x-4">
                        <a href="{{ route('posts.edit', $post) }}" 
                           class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                Delete
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <div class="prose max-w-none">
            {!! nl2br(e($post->content)) !!}
        </div>

        @auth
            <div class="mt-12 border-t pt-6">
                <h3 class="text-lg font-medium text-gray-900">Add a comment</h3>
                <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-4">
                    @csrf
                    <textarea name="content" rows="3" required
                              class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                              placeholder="Share your thoughts...">{{ old('content') }}</textarea>
                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    <div class="mt-4">
                        <x-primary-button>Post Comment</x-primary-button>
                    </div>
                </form>
            </div>
        @endauth

        <div class="mt-12">
            <h3 class="text-lg font-medium text-gray-900 mb-6">
                Comments ({{ $post->comments->count() }})
            </h3>
            <div class="space-y-6">
                @forelse($post->comments as $comment)
                    <x-comment :comment="$comment" />
                @empty
                    <p class="text-gray-500">No comments yet. Be the first to share your thoughts!</p>
                @endforelse
            </div>
        </div>
    </article>
</x-content-layout>