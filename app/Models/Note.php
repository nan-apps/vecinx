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

    public function scopeByTag($query, Tag $tag=NULL)
    {
        if($tag)
            return $query->where('tag_id', $tag->id);
        else
            return $query;
    }

    public function scopeByNeighbour($query, Neighbour $neighbour=NULL)
    {
        if($neighbour)
            return $query->where('neighbour_id', $neighbour->id);
        else
            return $query;
    }
}
