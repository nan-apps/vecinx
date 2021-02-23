<?php

namespace App\Models;

use App\Models\Traits\HasCommonScopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Note extends Model
{
  use HasFactory, SoftDeletes, HasCommonScopes;

  protected $fillable = ['body', 'tag_id', 'neighbour_id'];

  protected static function booted()
  {
    static::addGlobalScope('withNeighbour', function (Builder $builder) {
      $builder
      ->select(array_map(function($c){return "notes.{$c}";}, Schema::getColumnListing('notes')))
      ->join('neighbours', 'notes.neighbour_id', '=', 'neighbours.id')
      ->where('neighbours.deleted_at', null);
    });
  }

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
