<?php

// ビュー側にカテゴリーの選択肢を表示するために、
// カテゴリーモデルをインポートする必要があります
// 以下のようにPostControllerを修正します

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\posts;
use Illuminate\Support\Facades\Auth;
use App\Models\categories;
class PostController extends Controller
{
    public function create()
    {
        $categories = categories::all(); // すべてのカテゴリーを取得
        return view('post.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // サムネイルは任意
            'status' => 'required|in:draft,published,archived',
            'categories' => 'required|array', // カテゴリーは必須で配列形式
            'categories.*' => 'exists:categories,id', // 各カテゴリーIDがデータベースに存在するか確認
        ]);

        // サムネイルファイルを保存
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnailPath = $file->store('thumbnails', 'public'); // 'thumbnails' フォルダに保存（公開用）
        }

        // 投稿作成
        $post = posts::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'thumbnail' => $thumbnailPath,
            'status' => $request->status, // draft, published, archived
        ]);

        // 中間テーブルにカテゴリー情報を保存
        $post->categories()->attach($request->categories);

        return back()->with('success', '投稿が作成されました！');
    }
    public function index()
    {
        $posts = posts::published()->get(); // 公開記事のみ取得
        $categories = categories::all(); // すべてのカテゴリーを取得
        return view('post.index', compact('posts', 'categories'));
    }

    public function showDrafts()
    {
        $posts = posts::draft()->get(); // 下書き記事のみ取得
        return view('post.index', compact('posts'));
    }

    public function showArchived()
    {
        $posts = posts::archived()->get(); // アーカイブ記事のみ取得
        return view('post.index', compact('posts'));
    }

    public function show($slug)
{
    // スラッグでカテゴリーを取得
    $category = categories::where('slug', $slug)->firstOrFail();

    // カテゴリーに関連する公開された投稿を取得
    $posts = $category->posts()->published()->get(); // 公開された投稿のみ取得

    // ビューにカテゴリーと投稿を渡す
    return view('post.index', compact('category', 'posts'));
}
}
