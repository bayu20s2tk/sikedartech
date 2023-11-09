<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Complaint extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'course_id',
        'project_id',
        'blog_id',
        'comment_id',
        'user_id',
        'category_id',
        'status_id',
        'desc'
    ];

    const KEBENCIAN = 1;
    const SEKSUAL = 2;
    const MISINFORMASI = 3;
    const PENIPUAN = 4;
    const CATEGORY = [
        self::KEBENCIAN => 'Kebencian dan pelecehan',
        self::SEKSUAL => 'Konten seksual',
        self::MISINFORMASI => 'Misinformasi',
        self::PENIPUAN => 'Penipuan dan scam',
    ];

    const REQUEST = 1;
    const IGNORE = 2;
    const BANNED = 3;
    const STATUS = [
        self::REQUEST => 'Request',
        self::IGNORE => 'Abaikan',
        self::BANNED => 'Blokir',
    ];

    const COLOR = [
        self::REQUEST => 'text-primary-800 bg-primary-100',
        self::IGNORE => 'text-green-800 bg-green-100',
        self::BANNED => 'text-red-800 bg-red-100',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'category',
        'status',
        'color',
        'course_comment',
        'blog_comment'
    ];

    protected $with = [
        'course',
        'project',
        'blog',
        'user',
    ];

    public function getCategoryAttribute(): string
    {
        return self::CATEGORY[$this->category_id];
    }
    public function getStatusAttribute(): string
    {
        return self::STATUS[$this->status_id];
    }
    public function getColorAttribute(): string
    {
        return self::COLOR[$this->status_id];
    }
    public function getCourseCommentAttribute()
    {
        if ($this->course_id) {
            return CourseComment::where('id', $this->course_id)->first();
        }
        return null;
    }
    public function getBlogCommentAttribute()
    {
        if ($this->blog_id) {
            return BlogComment::where('id', $this->blog_id)->first();
        }
        return null;
    }
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class, 'blog_id', 'id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
