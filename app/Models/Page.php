<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'html',
        'css',
        'components',
        'styles',
        'is_published',
    ];

    protected $casts = [
        'components' => 'array',
        'styles' => 'array',
        'is_published' => 'boolean',
    ];
}
