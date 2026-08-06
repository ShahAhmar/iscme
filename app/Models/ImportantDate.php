<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ImportantDate extends Model { protected $fillable=['title','date','description','is_highlighted','sort_order','is_published']; protected function casts(): array { return ['date'=>'date','is_highlighted'=>'boolean','is_published'=>'boolean']; } }
