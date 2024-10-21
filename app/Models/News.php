<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'published_at',
        'source',
        'preview_url',
        'title',
        'description',
        'content',
        'url'
    ];

    protected $casts = [
        'published_at' => 'timestamp',
        'source' => 'string',
        'preview_url' => 'string',
        'title' => 'string',
        'description' => 'string',
        'content' => 'string',
        'url' => 'string',
    ];

}
