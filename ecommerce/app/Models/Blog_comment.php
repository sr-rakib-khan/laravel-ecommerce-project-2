<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog_comment extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'blog_id',
        'name',
        'email',
        'comment',
        'website',
        'created_at',
    ];
}
