<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $article->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                    By {{ $article->user->name }} · {{ $article->created_at->format('M d, Y') }}
                </p>
                <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200">
                    {!! nl2br(e($article->body)) !!}
                </div>
                <div class="mt-6 flex gap-3">
                    @can('update', $article)
                        <a href="{{ route('articles.edit', $article) }}"
                           class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">Edit</a>
                    @endcan
                    @can('delete', $article)
                        <form method="POST" action="{{ route('articles.destroy', $article) }}"
                              onsubmit="return confirm('Delete this article?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700">Delete</button>
                        </form>
                    @endcan
                    <a href="{{ route('articles.index') }}"
                       class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-sm rounded-md hover:bg-gray-300">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
