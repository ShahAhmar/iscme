<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = ['title','slug','excerpt','body','featured_image','category_id','author_id','status','published_at','seo_title','seo_description'];
    protected function casts(): array { return ['published_at' => 'datetime']; }
    public function category(): BelongsTo { return $this->belongsTo(Category::class); }
    public function author(): BelongsTo { return $this->belongsTo(User::class, 'author_id'); }
}
