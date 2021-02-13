<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, SoftDeletes;

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function neighbour()
    {
        return $this->belongsTo(Neighbour::class);
    }
}
