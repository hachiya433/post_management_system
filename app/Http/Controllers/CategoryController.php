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
