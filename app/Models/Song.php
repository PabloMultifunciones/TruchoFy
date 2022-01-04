<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'file',
        'user_id'
    ];

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
}
