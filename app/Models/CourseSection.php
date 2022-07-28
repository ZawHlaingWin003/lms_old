<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'section_name',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function zoom_meetings() {
        return $this->hasMany(ZoomMeeting::class);
    }

    public function lessons() {
        return $this->hasMany(Lesson::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
