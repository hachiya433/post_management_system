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
    ];
}
