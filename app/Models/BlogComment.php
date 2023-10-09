<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Overtrue\LaravelLike\Traits\Likeable;
use Overtrue\LaravelVote\Traits\Votable;

class BlogComment extends Model
{
    use HasFactory;
    use Votable;
//    use Likeable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'blog_id',
        'parent_id',
        'user_id',
        'content'
    ];
    protected $with = [
        'user',
        'child',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
//        'likers',
        'mother_name',
        'likes',
        'dislikes',
    ];

    public function getLikesAttribute(): string
    {
        return self::totalUpvotes();
    }
    public function getDislikesAttribute(): string
    {
        return self::totalDownvotes();
    }
    public function getMotherNameAttribute(): string
    {
        return User::where('id', BlogComment::where('id', $this->parent_id)->pluck('user_id')[0] ?? null)->pluck('name')[0] ?? '';
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class, 'blog_id', 'id');
    }
    public function child(): HasMany
    {
        return $this->hasMany(BlogComment::class, 'parent_id');
    }
}
