<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = ['user_id','title','slug','excerpt','content','image','status','published_at'];
    protected $casts    = ['published_at'=>'datetime'];

    public function author() { return $this->belongsTo(User::class, 'user_id'); }

    public function scopePublished($query) {
        return $query->where('status','published');
    }

    protected static function boot() {
        parent::boot();
        static::creating(fn($a) => $a->slug = Str::slug($a->title));
    }
}