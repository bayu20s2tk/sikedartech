<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'desc',
        'icon',
        'status_id'
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

    public function getStatusAttribute(): string
    {
        return self::STATUS[$this->status_id];
    }
}
