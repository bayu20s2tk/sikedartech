<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CourseSubscribe extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'course_id',
        'user_id',
        'admin_id',
        'status_id'
    ];

    const REQUEST = 1;
    const ACCEPT = 2;
    const REJECT = 3;
    const STATUS = [
        self::REQUEST => 'Request',
        self::ACCEPT => 'Accepted',
        self::REJECT => 'Rejected',
    ];

    const COLOR = [
        self::REQUEST => 'bg-primary-100 text-primary-800',
        self::ACCEPT => 'bg-green-100 text-green-800',
        self::REJECT => 'bg-red-100 text-red-800',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'status',
        'color'
    ];

    protected $with = [
        'media',
        'course',
        'user',
        'admin'
    ];

    public function getStatusAttribute(): string
    {
        return self::STATUS[$this->status_id];
    }
    public function getColorAttribute(): string
    {
        return self::COLOR[$this->status_id];
    }
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
}
