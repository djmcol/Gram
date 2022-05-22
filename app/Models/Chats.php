<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chats extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_sent',
        'post_recive'
    ];

    public function usersend(){
        return $this->belongsTo(User::class);
    }

    public function userrecive(){
        return $this->belongsTo(User::class);
    }

    public function messages(){
        return $this->hasMany(Messages::class , 'chat_id');
    }
}
