<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortQuestionAnswer extends Model
{
    use HasFactory;
    protected $fillable = ['user_id' , 'short_question_id' , 'student_answer'];
}
