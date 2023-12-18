<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Collection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
        'cover_photo',
    ];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    /**
     * Get all of the posts for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
    public function reactions(): HasMany
    {
        return $this->hasMany(Reaction::class);
    }
    /**
     * Get all of the friendRequestsSent for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function friendRequestsSent(): HasMany
    {
        return $this->hasMany(Friend::class);
    }
    /**
     * Get all of the friendRequestsReceived for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function friendRequestsReceived(): HasMany
    {
        return $this->hasMany(Friend::class, 'friend_id');
    }
    /**
     * Get the friends of the user.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\User[]
     */
    public function friends()
    {
        $friendsAdded = $this->friendRequestsSent()->whereNotNull('accepted_at')->pluck('friend_id');
        $friendsReceived = $this->friendRequestsReceived()->whereNotNull('accepted_at')->pluck('user_id');
        $friendsIds = $friendsAdded->merge($friendsReceived)->unique()->toArray();
        return User::whereIn('id', $friendsIds);
    }
}
