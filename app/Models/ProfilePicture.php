<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePicture extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'path',
        'size',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
