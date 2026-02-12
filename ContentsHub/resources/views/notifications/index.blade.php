<x-content-layout>
    <x-slot name="title">Notifications</x-slot>
    <x-slot name="actions">
        <form action="{{ route('notifications.mark-all-read') }}" method="POST" class="inline">
            @csrf
            <x-secondary-button type="submit">
                Mark all as read
            </x-secondary-button>
        </form>
    </x-slot>

    <div class="space-y-4">
        @forelse($notifications as $notification)
            <div class="bg-white rounded-lg shadow p-4 {{ $notification->read_at ? 'opacity-75' : '' }}">
                @if($notification->type === 'new_comment')
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm">
                                <span class="font-medium">{{ $notification->data['commenter_name'] }}</span>
                                commented on your post
                                <a href="{{ route('posts.show', $notification->data['post_id']) }}" 
                                   class="text-blue-600 hover:text-blue-800">
                                    "{{ $notification->data['post_title'] }}"
                                </a>
                            </p>
                            <span class="text-xs text-gray-500">
                                {{ $notification->created_at->diffForHumans() }}
                            </span>
                        </div>

                        @if(!$notification->read_at)
                            <form action="{{ route('notifications.mark-read', $notification) }}" 
                                  method="POST" class="flex-shrink-0">
                                @csrf
                                <button type="submit" 
                                        class="text-sm text-gray-600 hover:text-gray-900">
                                    Mark as read
                                </button>
                            </form>
                        @endif
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center py-12">
                <h3 class="text-lg font-medium text-gray-900">No notifications</h3>
                <p class="mt-2 text-sm text-gray-600">
                    You're all caught up! Check back later for new updates.
                </p>
            </div>
        @endforelse

        <div class="mt-6">
            {{ $notifications->links() }}
        </div>
    </div>
</x-content-layout>