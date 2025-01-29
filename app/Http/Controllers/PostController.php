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
        ]);

        // サムネイルファイルを保存
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnailPath = $file->store('thumbnails', 'public'); // 'thumbnails' フォルダに保存（公開用）
        }

        $post = posts::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'thumbnail' => $thumbnailPath
        ]);

        return back()->with('success', '投稿が作成されました！');
    }
    public function index()
    {
        $posts=posts::all();
        return view('post.index', compact('posts'));
    }
}
