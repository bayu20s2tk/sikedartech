<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectBid extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'project_id',
        'user_id',
        'desc',
        'price',
        'status_id',
    ];

    const NOTSELECTED = 0;
    const SELECTED = 1;
    const STATUS = [
        self::NOTSELECTED => 'Tidak Terpilih',
        self::SELECTED => 'Terpilih',
    ];
    const COLOR = [
        self::NOTSELECTED => 'bg-red-100 text-red-800',
        self::SELECTED => 'bg-green-100 text-green-800',
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
//        'project',
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
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
