<x-content-layout>
    <x-slot name="title">
        Welcome to {{ config('app.name') }}
    </x-slot>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 dark:from-blue-700 dark:to-blue-900 text-white rounded-lg shadow-lg p-8 mb-12">
        <div class="max-w-3xl mx-auto text-center">
            @guest
                <div class="space-x-4">
                    <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 bg-white text-blue-700 rounded-md font-semibold text-sm hover:bg-blue-50 transition">
                        Get Started
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 border border-white text-white rounded-md font-semibold text-sm hover:bg-blue-600 transition">
                        Sign In
                    </a>
                </div>
            @else
                <a href="{{ route('posts.create') }}" class="inline-flex items-center px-6 py-3 bg-white text-blue-700 rounded-md font-semibold text-sm hover:bg-blue-50 transition">
                    Create New Post
                </a>
            @endguest
        </div>
    </div>

    <!-- Featured Posts Section -->
    {{-- <div class="mb-12">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Latest Posts</h2>
            <a href="{{ route('posts.index') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                View All →
            </a>
        </div>

        @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <h3 class="text-xl font-semibold mb-2">
                            <a href="{{ route('posts.show', $post) }}" class="text-gray-900 dark:text-gray-100 hover:text-blue-600 dark:hover:text-blue-400">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                            {{ Str::limit(strip_tags($post->content), 100) }}
                        </p>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">
                                By {{ $post->user->name }}
                            </span>
                            <span class="text-gray-500 dark:text-gray-400">
                                {{ $post->published_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-lg shadow">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">No posts yet</h3>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Be the first to share something interesting!</p>
            </div>
        @endif
    </div>

    <!-- Features Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="text-blue-600 dark:text-blue-400 text-2xl mb-4">✍️</div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Share Your Stories</h3>
            <p class="text-gray-600 dark:text-gray-400">Create and publish your content with our easy-to-use editor.</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="text-blue-600 dark:text-blue-400 text-2xl mb-4">💬</div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Engage in Discussions</h3>
            <p class="text-gray-600 dark:text-gray-400">Comment on posts and interact with other members of the community.</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="text-blue-600 dark:text-blue-400 text-2xl mb-4">🔔</div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Stay Updated</h3>
            <p class="text-gray-600 dark:text-gray-400">Get notified when people interact with your content.</p>
        </div>
    </div> --}}
</x-content-layout>