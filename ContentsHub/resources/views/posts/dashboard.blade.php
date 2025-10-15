<x-content-layout>
    <x-slot name="title">My Posts</x-slot>
    <x-slot name="actions">
        <a href="{{ route('posts.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
            New Post
        </a>
    </x-slot>

    <div class="space-y-6">
        @forelse($posts as $post)
            <x-post-card :post="$post" />
        @empty
            <div class="text-center py-12">
                <h3 class="text-lg font-medium text-gray-900">No posts yet</h3>
                <p class="mt-2 text-sm text-gray-600">
                    Start sharing your thoughts by creating your first post!
                </p>
                <div class="mt-6">
                    <a href="{{ route('posts.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                        Create Your First Post
                    </a>
                </div>
            </div>
        @endforelse

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
</x-content-layout>