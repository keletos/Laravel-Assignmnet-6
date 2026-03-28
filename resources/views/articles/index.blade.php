<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Articles
            </h2>
            @can('create', App\Models\Article::class)
                <a href="{{ route('articles.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">
                    New Article
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @forelse ($articles as $article)
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                <a href="{{ route('articles.show', $article) }}" class="hover:underline">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                By {{ $article->user->name }} · {{ $article->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <div class="flex gap-2 ml-4">
                            @can('update', $article)
                                <a href="{{ route('articles.edit', $article) }}"
                                   class="text-sm text-indigo-600 hover:underline">Edit</a>
                            @endcan
                            @can('delete', $article)
                                <form method="POST" action="{{ route('articles.destroy', $article) }}"
                                      onsubmit="return confirm('Delete this article?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:underline">Delete</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                    <p class="mt-3 text-gray-700 dark:text-gray-300 text-sm line-clamp-3">
                        {{ Str::limit($article->body, 200) }}
                    </p>
                </div>
            @empty
                <p class="text-gray-500 dark:text-gray-400">No articles found.</p>
            @endforelse

        </div>
    </div>
</x-app-layout>
