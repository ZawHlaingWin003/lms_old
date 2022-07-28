<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summernote extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'course_section_id',
        'page_number',
        'content',
    ];
}
