<?php

namespace App\Models;

use App\Models\Reply;
use Illuminate\Database\Eloquent\Model;

class Discus extends Model
{
  

    protected $fillable = ['created_by', 'title', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'replies_to');
    }
}