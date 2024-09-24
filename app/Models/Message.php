<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['user_id', 'friend_id', 'message'];

    public function sender(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function receiver(){
        return $this->belongsTo(User::class, 'friend_id');
    }
}
