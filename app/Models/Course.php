<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Overtrue\LaravelFollow\Traits\Followable;
use Overtrue\LaravelSubscribe\Traits\Subscribable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Course extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Subscribable;
//    use Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'slug',
        'name',
        'desc',
        'about',
        'price',
        'status_id',
        'category_id',
        'user_id',
    ];

    const ACTIVE = 1;
    const NONACTIVE = 2;
    const DRAFT = 3;
    const STATUS = [
        self::ACTIVE => 'Aktif',
        self::NONACTIVE => 'Nonaktif',
        self::DRAFT => 'Draft',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'status'
    ];

    protected $with = [
        'media',
        'user',
        'category',
        'item',
        'assigment',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    public function getStatusAttribute(): string
    {
        return self::STATUS[$this->status_id];
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(CourseCategory::class, 'category_id', 'id');
    }
    public function item(): HasMany
    {
        return $this->hasMany(CourseItem::class, 'course_id', 'id')->where('type_id', CourseItem::LESSON);
    }
    public function assigment(): HasMany
    {
        return $this->hasMany(CourseItem::class, 'course_id', 'id')->where('type_id', CourseItem::ASSIGMENT);
    }
    public function comment(): HasMany
    {
        return $this->hasMany(CourseComment::class)->whereNull('parent_id')->latest();
    }
}
