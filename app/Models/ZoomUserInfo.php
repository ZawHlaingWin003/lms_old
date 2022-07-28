<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomUserInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'zoom_username',
        'zoom_email',
        'api_key',
        'api_secret'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
