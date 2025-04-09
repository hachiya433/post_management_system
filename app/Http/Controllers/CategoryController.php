<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = categories::all();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
        ]);

        categories::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->route('category.index')->with('success', 'カテゴリが作成されました。');
    }

    public function edit(categories $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, categories $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->route('category.index')->with('success', 'カテゴリが更新されました。');
    }

    public function destroy(categories $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('success', 'カテゴリが削除されました。');
    }

    public function show($slug)
    {
        // スラッグでカテゴリーを取得
        $category = categories::where('slug', $slug)->firstOrFail();

        // カテゴリーに関連する公開された投稿を取得（ページネーション付き）
        $posts = $category->posts()->published()->paginate(9);

        // すべてのカテゴリーを取得
        $categories = categories::all();

        // ビューにカテゴリーと投稿を渡す
        return view('post.index', compact('category', 'posts', 'categories'));
    }
}
