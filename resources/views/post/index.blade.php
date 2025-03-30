<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            一覧表示
        </h2>
    </x-slot>
<!-- 投稿ページ上部にカテゴリー一覧を表示 -->
<div class="categories bg-white p-4 rounded-lg shadow-md mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">カテゴリー一覧</h3>
    <ul class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach ($categories as $cat)
            <li>
                <a href="{{ route('category.show', $cat->slug) }}" 
                   class="block px-4 py-2 text-sm font-medium text-gray-700 bg-gray-50 rounded-md hover:bg-gray-100 transition-colors duration-200">
                    {{ $cat->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
    <div class="mx-auto px-6">
        @foreach($posts as $post)
        <div class="mt-4 p-8 bg-white w-full rounded-2xl">
            <h1 class="p-4 text-lg font-lg font-semibold">
                {{$post->title}}
            </h1>
            <hr class="w-full">
            <div class="p-4 text-sm font-semibold">
                <p>
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="サムネイル" class="w-32 h-32 object-cover">
                </p>
            </div>
            <p class="mt-4 p-4">
                {{$post->content}}
            </p>
            <p class="mt-4 p-4">
            状態: 
            @if ($post->status === 'published')
                公開
            @elseif ($post->status === 'draft')
                下書き
            @else
                アーカイブ済み
            @endif
            </p>
            <div class="p-4 text-sm font-semibold">
                <p>
                    {{$post->created_at}}
                </p>
            </div>
        </div>
        @endforeach

    {{ $posts->links() }}
    </div>
</x-app-layout>
