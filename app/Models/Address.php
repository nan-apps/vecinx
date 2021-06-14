<?php

namespace App\Models;

use App\Models\Neighbour;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'address', 'lat', 'lng', 'hood_id', 'address_notes','route_id', 'name'
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

}
