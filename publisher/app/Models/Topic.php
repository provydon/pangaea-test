<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    public function subscribers()
    {
        return $this->belongsToMany(Subscriber::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
