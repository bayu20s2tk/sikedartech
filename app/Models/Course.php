<?php

namespace App\Models;

//use Codebyray\ReviewRateable\Contracts\ReviewRateable;
//use Codebyray\ReviewRateable\Traits\ReviewRateable as ReviewRateableTrait;
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
//    use ReviewRateableTrait;

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

    const REQUEST = 0;
    const ACTIVE = 1;
    const NONACTIVE = 2;
    const DRAFT = 3;
    const STATUS = [
        self::REQUEST => 'Validasi',
        self::ACTIVE => 'Aktif',
        self::NONACTIVE => 'Nonaktif',
        self::DRAFT => 'Draft',
    ];

    const COLOR = [
        self::REQUEST => 'bg-gray-100 text-gray-800',
        self::ACTIVE => 'bg-green-100 text-green-800',
        self::NONACTIVE => 'bg-red-100 text-red-800',
        self::DRAFT => 'bg-amber-100 text-amber-800',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'status',
        'color',
        'review_average',
    ];

    protected $with = [
        'media',
        'user',
        'category',
        'item',
        'assigment',
        'member',
        'review'
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    public function getStatusAttribute(): string
    {
        return self::STATUS[$this->status_id];
    }
    public function getColorAttribute(): string
    {
        return self::COLOR[$this->status_id];
    }
    public function getReviewAverageAttribute()
    {
        return Review::Where([['course_id', $this->id],])->pluck('rating')->avg();
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
    public function member(): HasMany
    {
        return $this->hasMany(CourseSubscribe::class, 'course_id', 'id')->where('status_id', '!=', CourseSubscribe::REQUEST)->latest();
    }
    public function review(): HasMany
    {
        return $this->hasMany(Review::class, 'course_id', 'id')->latest();
    }
}
