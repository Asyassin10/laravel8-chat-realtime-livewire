<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['message', 'user_id', 'receiver_id', 'is_seen', 'picture'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}