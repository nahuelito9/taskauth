<?php

namespace App\Models;
use App\Models\User;


use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'completed', 'user_id'];

    public function user()
{
    return $this->belongsTo(User::class);
}
}
