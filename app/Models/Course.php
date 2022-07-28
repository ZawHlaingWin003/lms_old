<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_category_id',
        'course_name',
        'course_id',
        'from_date',
        'to_date',
        'visible',
        'description'
    ];

    public function course_category() {
        return $this->belongsTo(CourseCategory::class);
    }

    public function course_sections() {
        return $this->hasMany(CourseSection::class);
    }

    public function zoom_meetings() {
        return $this->hasManyThrough(ZoomMeeting::class, CourseSection::class);
    }
}
