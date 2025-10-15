<x-content-layout>
    <x-slot name="title">My Posts</x-slot>
    <x-slot name="actions">
        <a href="{{ route('posts.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
            New Post
        </a>
    </x-slot>

    <div x-data="{ show: false, post: null }" x-init="
        if (window.Echo) {
            Echo.channel('posts')
                .listen('PostCreated', (e) => {
                    show = true;
                    post = e;
                    setTimeout(() => show = false, 5000);
                });
        }
    " class="space-y-6">
        <template x-if="show">
            <div class="mb-4">
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded relative flex items-center" role="alert">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0a9 9 0 0118 0z" /></svg>
                    <span class="block sm:inline font-semibold">New post created:</span>
                    <span class="ml-2" x-text="post ? post.title : ''"></span>
                </div>
            </div>
        </template>

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