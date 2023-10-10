<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'slug',
        'name',
        'desc',
        'budget_from',
        'budget_to',
        'status_id',
        'category_id',
        'user_id',
    ];

    const ACTIVE = 1;
    const NONACTIVE = 2;
    const ONGOING = 3;
    const FINISH = 4;
    const STATUS = [
        self::ACTIVE => 'Terbuka',
        self::NONACTIVE => 'Nonaktif',
        self::ONGOING => 'Sedang Berlangsung',
        self::FINISH => 'Selesai'
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
        return $this->belongsTo(ProjectCategory::class, 'category_id', 'id');
    }
}
