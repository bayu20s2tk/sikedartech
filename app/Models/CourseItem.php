<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'course_id',
        'user_id',
        'type_id',
        'name',
        'content'
    ];

    const LESSON = 1;
    const ASSIGMENT = 2;

    const TYPE = [
        self::LESSON => 'Lesson',
        self::ASSIGMENT => 'Assigment',
    ];

//    protected $with = [
//        'user',
//    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
