<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
    protected $fillable = ['original_name', 'path', 'disk', 'mime_type', 'size', 'alt_text', 'caption', 'folder', 'uploaded_by'];

    protected function casts(): array { return ['size' => 'integer']; }

    public function uploader(): BelongsTo { return $this->belongsTo(User::class, 'uploaded_by'); }
}
