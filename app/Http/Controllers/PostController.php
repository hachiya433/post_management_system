<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\posts;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create() {
        return view('post.create');
    }

    public function store(Request $request) {
        $post = posts::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content
        ]);

        return back();
    }
}
