<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'story_id',
        'parent_id',
        'name',
        'email',
        'body',
        'approved',
    ];

    protected $casts = [
        'approved' => 'boolean',
    ];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}


