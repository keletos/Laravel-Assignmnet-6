<div class="space-y-4">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
        <input type="text" name="title" id="title"
               value="{{ old('title', $article->title ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100
                      focus:border-indigo-500 focus:ring-indigo-500 @error('title') border-red-500 @enderror">
        @error('title')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="body" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Body</label>
        <textarea name="body" id="body" rows="8"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100
                         focus:border-indigo-500 focus:ring-indigo-500 @error('body') border-red-500 @enderror">{{ old('body', $article->body ?? '') }}</textarea>
        @error('body')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>
