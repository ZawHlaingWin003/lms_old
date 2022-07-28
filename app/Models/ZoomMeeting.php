<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomMeeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'course_section_id',
        'topic',
        'start_time',
        'agenda',
        'description',
        'meeting_id',
        'start_url',
        'join_url',
        'meeting_password'
    ];

    public function course_section() {
        return $this->belongsTo(CourseSection::class);
    }
}
