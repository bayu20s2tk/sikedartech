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
        'worker_id',
        'user_id',
        'finish_day',
        'deadline_date'
    ];

    const REQUEST = 0;
    const OPEN = 1;
    const SELECTED = 2;
    const ONGOING = 3;
    const FINISH = 4;
    const PAID = 5;

    const CANCEL = 6;
    const STATUS = [
        self::REQUEST => 'Registered',
        self::OPEN => 'Tayang',
        self::SELECTED => 'Terpilih',
        self::ONGOING => 'Berlangsung',
        self::FINISH => 'Selesai',
        self::PAID => 'Selesai',
        self::CANCEL => 'Batal'
    ];

    const COLOR = [
        self::REQUEST => 'bg-amber-100 text-amber-800',
        self::OPEN => 'bg-primary-100 text-primary-800',
        self::SELECTED => 'bg-primary-100 text-primary-800',
        self::ONGOING => 'bg-primary-100 text-primary-800',
        self::FINISH => 'bg-green-100 text-green-800',
        self::PAID => 'bg-indigo-100 text-indigo-800',
        self::CANCEL => 'bg-red-100 text-red-800'
    ];

    const BILLING = [
        self::REQUEST => '',
        self::OPEN => '',
        self::SELECTED => '',
        self::ONGOING => '',
        self::FINISH => 'Belum dibayar',
        self::PAID => 'Sudah dibayar',
        self::CANCEL => ''
    ];

    const TIGAHARI = 3;
    const SEMINGGU = 7;
    const DUAMINGGU = 14;
    const SEBULAN = 30;
    const DAY = [
        self::TIGAHARI => '3 Hari',
        self::SEMINGGU => '7 Hari',
        self::DUAMINGGU => '14 Hari',
        self::SEBULAN => '30 Hari'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'status',
        'color',
        'billing'
    ];

    protected $with = [
        'media',
        'user',
        'worker',
        'category',
        'bid',
//        'chat'
        'progress'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'deadline_date' => 'datetime',
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
    public function getBillingAttribute(): string
    {
        return self::BILLING[$this->status_id];
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function worker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'worker_id', 'id');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id', 'id');
    }
    public function bid(): hasMany
    {
        return $this->hasMany(ProjectBid::class, 'project_id', 'id');
    }
    public function chat(): hasMany
    {
        return $this->hasMany(ProjectChat::class, 'project_id', 'id');
    }
    public function progress(): hasMany
    {
        return $this->hasMany(ProjectProgress::class, 'project_id', 'id');
    }
}
