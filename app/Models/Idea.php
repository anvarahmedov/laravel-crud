<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Idea extends Model
{


   protected $fillable = [
         'user_id',
        'content',
 ];

 protected $withCount = ['likes'];

    use HasFactory;

    protected $with = [
        'user:id,name,image', 'comments.user:id,name,image'
    ];

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function likes() {
        return $this->belongsToMany(User::class, 'idea_like')->withTimestamps();
    }

    public function likesCount() {
        return $this->likes()->count();
    }

    public function scopeSearch(Builder $query,$search = ''): void {
        $query->where('content', 'like', '%' . $search . '%');
    }
}
