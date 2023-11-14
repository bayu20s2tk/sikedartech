<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'course_id',
        'worker_id',
        'owner_id',
        'desc',
        'rating',
        'user_id',
    ];

    protected $with = [
        'user',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(User::class, 'course_id', 'id');
    }
    public function worker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'worker_id', 'id');
    }
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
