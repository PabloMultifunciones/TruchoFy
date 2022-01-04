<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class song_user extends Model
{
    use HasFactory;

    protected $table = "song_user";

    protected $fillable = [
        'user_id',
        'song_id'
    ];
}
