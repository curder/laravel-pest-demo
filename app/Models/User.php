<?php

namespace App\Models;

use App\Models\Pivot\BookUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property integer $id
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class)
                    ->using(BookUser::class)
                    ->withPivot(['status'])
                    ->withTimestamps();
    }

    public function addFriend(User $friend): void
    {
        $this->friendsOfMine()->syncWithPivotValues($friend, [
            'accepted' => false,
        ], false);
    }

    public function acceptFriend(User $friend): void
    {
        $friend->friendsOfMine()->updateExistingPivot($this->id, [
            'accepted' => true,
        ]);
    }

    public function friendsOfMine(): BelongsToMany
    {
        return $this->belongsToMany(__CLASS__, 'friends', 'user_id', 'friend_id')
                   ->withPivot('accepted')
                   ->withTimestamps();
    }

    public function friendsOf(): BelongsToMany
    {
        return $this->belongsToMany(__CLASS__, 'friends', 'friend_id', 'user_id')
                    ->withPivot('accepted')
                    ->withTimestamps();
    }

    public function pendingFriendsOfMine(): BelongsToMany
    {
        return $this->friendsOfMine()->wherePivot('accepted', false);
    }

    public function pendingFriendsOf(): BelongsToMany
    {
        return $this->friendsOf()->wherePivot('accepted', false);
    }

    public function acceptedFriendsOfMine(): BelongsToMany
    {
        return $this->friendsOfMine()->wherePivot('accepted', true);
    }
}
