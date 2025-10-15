<x-content-layout>
    <x-slot name="title">Create New Post</x-slot>

    <div class="max-w-2xl mx-auto">
        <form action="{{ route('posts.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <x-input-label for="title" value="Title" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" 
                             :value="old('title')" required autofocus />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="content" value="Content" />
                <textarea id="content" name="content" rows="10" 
                          class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 shadow-sm"
                          required>{{ old('content') }}</textarea>
                <x-input-error :messages="$errors->get('content')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="status" value="Status" />
                <select id="status" name="status" 
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 shadow-sm">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                </select>
                <x-input-error :messages="$errors->get('status')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end gap-4">
                <x-secondary-button type="button" onclick="window.location.href='{{ route('posts.index') }}'">
                    Cancel
                </x-secondary-button>
                <x-primary-button>Create Post</x-primary-button>
            </div>
        </form>
    </div>
</x-content-layout>