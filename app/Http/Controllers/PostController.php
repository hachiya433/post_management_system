<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\posts;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // サムネイルは任意
            'status' => 'required|in:draft,published,archived',
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

        return back()->with('success', '投稿が作成されました！');
    }
    public function index()
    {
        $posts = posts::published()->get(); // 公開記事のみ取得
        return view('post.index', compact('posts'));
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
}
