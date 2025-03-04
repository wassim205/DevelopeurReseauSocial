<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    protected $fillable = ['user_id', 'connection_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function connectionUser()
    {
        return $this->belongsTo(User::class, 'connection_id');
    }
}
