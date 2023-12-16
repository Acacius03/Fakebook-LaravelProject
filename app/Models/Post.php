<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'body'
    ];
    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the postMedia associated with the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function postMedias(): HasMany
    {
        return $this->hasMany(PostMedia::class);
    }
    /**
     * Get all of the reactions for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reactions(): HasMany
    {
        return $this->hasMany(Reaction::class);
    }
    /**
     * Check if the reaction is given by the specified user.
     *
     * @param  int  $user_id
     * @return bool
     */
    public function reactedBy(int $user_id): bool
    {
        return $this->reactions()->where('user_id', $user_id)->exists();
    }
}
