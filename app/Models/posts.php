<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class posts extends Model
{
    use HasFactory;
    Protected $fillable = [
        'user_id',
        'title',
        'content',
        'thumbnail',
        'status'
    ];

    public function categories()
    {
        return $this->belongsToMany(categories::class, 'category_post', 'post_id', 'category_id');
    }

    // 公開記事のみ取得するスコープ
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // 下書きの記事のみ取得するスコープ
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    // アーカイブ済みの記事のみ取得するスコープ
    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }
}
