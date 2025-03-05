<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'biography',
        'skills',
        'languages',
        'projects',
        'githubProfile'
    ];

    protected $casts = [
        'skills' => 'array',
        'languages' => 'array',
        'projects' => 'array',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function connections()
    {
        return $this->hasMany(Connection::class, 'user_id');
    }

    public function connectedUsers()
    {
        return $this->belongsToMany(User::class, 'connections', 'user_id', 'connection_id');
    }
    public function connectedUserss()
    {
        return $this->belongsToMany(User::class, 'connections', 'connection_id', 'user_id');
    }
}
