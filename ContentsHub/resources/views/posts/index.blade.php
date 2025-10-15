<x-content-layout>
    <x-slot name="title">
        @guest
            Welcome to {{ config('app.name') }}
        @else
            Latest Posts
        @endguest
    </x-slot>
    
    <x-slot name="actions">
        @auth
            <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-blue-600">
                New Post
            </a>
        @endauth
    </x-slot>

    @guest
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 dark:from-blue-700 dark:to-blue-900 text-white rounded-lg shadow-lg p-6 mb-8">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-3xl font-bold mb-4">Share Your Thoughts with the World</h1>
                <p class="text-lg mb-6">Join our community of writers and readers. Create, share, and engage with amazing content.</p>
                <div class="space-x-4">
                    <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 bg-white text-blue-700 rounded-md font-semibold text-sm hover:bg-blue-50 transition">
                        Get Started
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 border border-white text-white rounded-md font-semibold text-sm hover:bg-blue-600 transition">
                        Sign In
                    </a>
                </div>
            </div>
        </div>
    @endguest

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            @forelse($posts as $post)
                <x-post-card :post="$post" />
            @empty
                <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-lg shadow">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">No posts yet</h3>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Be the first to share something interesting!</p>
                    @auth
                        <div class="mt-6">
                            <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-blue-600">
                                Create Your First Post
                            </a>
                        </div>
                    @endauth
                </div>
            @endforelse

            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- About Section -->
            {{-- <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">About {{ config('app.name') }}</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    A platform for sharing thoughts, ideas, and stories with a global community of readers and writers.
                </p>
            </div> --}}

            @auth
                <!-- Quick Links -->
                {{-- <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Quick Links</h3>
                    <nav class="space-y-2">
                        <a href="{{ route('dashboard') }}" class="flex items-center text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400">
                            <span class="mr-2">📝</span>
                            My Posts
                        </a>
                        <a href="{{ route('notifications.index') }}" class="flex items-center text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400">
                            <span class="mr-2">🔔</span>
                            Notifications
                        </a>
                        <a href="{{ route('settings.profile.edit') }}" class="flex items-center text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400">
                            <span class="mr-2">⚙️</span>
                            Settings
                        </a>
                    </nav>
                </div> --}}
            @endauth
        </div>
    </div>
</x-content-layout>