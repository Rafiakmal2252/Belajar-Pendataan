<?php

namespace App\Models;

use App\Models\Discus;
use Illuminate\Database\Eloquent\Model;


class Reply extends Model
{

    protected $fillable = ['replies_to', 'created_by', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function discus()
    {
        return $this->belongsTo(Discus::class, 'replies_to');
    }
}