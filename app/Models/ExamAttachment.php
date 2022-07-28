<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_id',
        'file_name',
        'file_type',
        'file_size'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
