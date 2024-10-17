<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'body',
        'thumbnail',
        'user_id',
        'post_status_id'
    ];

    // protected $guarded = [
    //     'id'
    // ];




    // Relationships
    function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }


    function reactions(): HasMany
    {
        return $this->hasMany(Reaction::class);
    }

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    function postStatus(): BelongsTo
    {
        return $this->belongsTo(PostStatus::class);
    }
}
