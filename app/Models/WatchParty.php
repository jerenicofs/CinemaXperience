<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchParty extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'watch_parties';

    public function media(){
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function participants(){
        return $this->belongsToMany(User::class, 'watch_parties_participants', 'watch_parties_id', 'user_id');
    }

    public function chats(){
        return $this->hasMany(Chat::class, 'watch_parties_id');
    }
}
