<?php

namespace App\Models;

use App\Models\Traits\HasCommonScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, SoftDeletes, HasCommonScopes;

    protected $fillable = ['body', 'tag_id', 'neighbour_id'];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function neighbour()
    {
        return $this->belongsTo(Neighbour::class);
    }

    public function scopeByTagId($query, $tagId=NULL)
    {
        if($tagId)
            return $query->where('tag_id', $tagId);
        else
            return $query;
    }
}
