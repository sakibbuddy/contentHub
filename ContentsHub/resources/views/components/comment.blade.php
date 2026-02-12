@props(['comment'])

<div class="border-b border-gray-200 dark:border-gray-700 py-4 last:border-0">
    <div class="flex justify-between items-start">
        <div class="flex items-start space-x-3">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300">
                    {{ $comment->user->initials() }}
                </div>
            </div>
            <div>
                <div class="flex items-center space-x-2">
                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $comment->user->name }}</span>
                    <span class="text-gray-500 dark:text-gray-400 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <div class="mt-1 text-gray-800 dark:text-gray-200">
                    {{ $comment->content }}
                </div>
            </div>
        </div>
        
        @if(auth()->id() === $comment->user_id || auth()->id() === $comment->post->user_id)
            <form action="{{ route('comments.destroy', $comment) }}" method="POST" 
                  onsubmit="return confirm('Are you sure you want to delete this comment?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 text-sm">
                    Delete
                </button>
            </form>
        @endif
    </div>
</div>