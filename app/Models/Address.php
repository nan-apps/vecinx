<?php

namespace App\Models;

use App\Models\Neighbour;
use App\Models\Traits\HasCommonScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Address extends Model implements Sortable
{
  use HasFactory, SoftDeletes, HasCommonScopes, SortableTrait;

  protected $fillable = [
    'address', 'lat', 'lng', 'hood_id', 'address_notes','route_id', 'name', 
    'order_column'
  ];

  public function neighbours()
  {
    return $this->hasMany(Neighbour::class);
  }

  public function route()
  {
    return $this->belongsTo(Route::class);
  }

  public function hood()
  {
    return $this->belongsTo(Hood::class);
  }

  public function fullAddress()
  {
    return "{$this->address}, {$this->hood->name}";
  }

  public function getFullNameAttribute()
  {
    if($this->name){
      return "{$this->name} ({$this->address})";
    } else {
      return "{$this->address}";
    }

  }

   public function buildSortQuery()
  {
      return static::query()->where('route_id', $this->route_id);
  }

}
