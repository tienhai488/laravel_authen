<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Group extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'groups';

    public function userDetail()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function users()
    {
        return $this->hasMany(User::class,'group_id','id');
    }
}