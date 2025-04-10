<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchLaterVideo extends Model
{
    /** @use HasFactory<\Database\Factories\WatchLaterVideoFactory> */
    use HasFactory;

    protected $fillable = [
        'platform',
        'video_id',
        'url',
        'title',
        'thumbnail',
        'watched',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
