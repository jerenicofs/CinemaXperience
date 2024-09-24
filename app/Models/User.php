<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function UserColumn()
    {
        return $this->belongsToMany(User::class, 'user_friend_lists', 'user_id','friend_id')
                    ->withPivot('id','status')
                    ->withTimestamps();
    }

    public function FriendColumn()
    {
        return $this->belongsToMany(User::class, 'user_friend_lists', 'friend_id','user_id')
                    ->withPivot('id','status')
                    ->withTimestamps();

    }

    public function watchParties(){
        return $this->belongsToMany(WatchParty::class, 'watch_parties_participants', 'user_id', 'watch_parties_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
