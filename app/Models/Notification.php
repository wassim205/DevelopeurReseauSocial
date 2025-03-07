<?php
namespace App\Models;
use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
    protected $fillable = ['id', 'type', 'data', 'notifiable_type', 'notifiable_id', 'read_at'];
    public function notifiable()
    {
        return $this->morphTo();
    }
}
