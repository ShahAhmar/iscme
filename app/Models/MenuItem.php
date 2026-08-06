<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MenuItem extends Model { protected $fillable=['label','url','location','target','sort_order','is_published']; protected function casts():array{return ['is_published'=>'boolean'];} }
