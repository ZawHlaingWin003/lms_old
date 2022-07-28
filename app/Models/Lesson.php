<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'course_section_id',
        'lesson_name'
    ];

    public function lesson_contents()
    {
        return $this->hasMany(LessonContent::class);
    }
}
