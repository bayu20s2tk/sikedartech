<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blog extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'slug',
        'name',
        'desc',
        'content',
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
        'category'
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id', 'id');
    }
    public function getStatusAttribute(): string
    {
        return self::STATUS[$this->status_id];
    }
}
