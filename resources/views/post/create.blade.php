<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿作成
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- タイトル -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">タイトル</label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('title') }}">
                        @error('title')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- コンテンツ -->
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700">コンテンツ</label>
                        <textarea name="content" id="content" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('content') }}</textarea>
                        @error('content')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- サムネイル -->
                    <div class="mb-4">
                        <label for="thumbnail" class="block text-sm font-medium text-gray-700">サムネイル</label>
                        <input type="file" name="thumbnail" id="thumbnail" class="mt-1 block w-full text-sm text-gray-900 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" accept="image/*">
                        @error('thumbnail')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- カテゴリー -->
                    <div class="mb-4">
                        <label for="categories" class="block text-sm font-medium text-gray-700">カテゴリー</label>
                        <select name="categories[]" id="categories" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('categories')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- ステータス -->
                    <div class="mb-4">
                        <label for="status">ステータス</label>
                        <select name="status" id="status">
                            <option value="draft">下書き</option>
                            <option value="published">公開</option>
                            <option value="archived">アーカイブ済み</option>
                        </select>
                        @error('status')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- 送信ボタン -->
                    <div>
                        <x-primary-button>投稿する</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>