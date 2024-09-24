<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'medias';

    public function genre()
    {
        return $this->belongsToMany(Genre::class, 'media_genres');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
