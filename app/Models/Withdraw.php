<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Withdraw extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'amount',
        'status_id',
        'user_id',
        'admin_id',
        'desc'
    ];

    const REQUEST = 1;
    const APPROVE = 2;
    const SEND = 3;
    const DENIED = 4;
    const STATUS = [
        self::REQUEST => 'Request',
        self::APPROVE => 'Disetujui',
        self::SEND => 'Sudah Dibayar',
        self::DENIED => 'Ditolak',
    ];

    const COLOR = [
        self::REQUEST => 'text-amber-800 bg-amber-100',
        self::APPROVE => 'text-green-800 bg-green-100',
        self::SEND => 'text-primary-800 bg-primary-100',
        self::DENIED => 'text-red-800 bg-red-100',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'status',
        'color',
    ];

    protected $with = [
        'user',
    ];

    public function getStatusAttribute(): string
    {
        return self::STATUS[$this->status_id];
    }

    public function getColorAttribute(): string
    {
        return self::COLOR[$this->status_id];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
