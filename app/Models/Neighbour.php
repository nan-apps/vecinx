<?php

namespace App\Models;

use App\Models\Hood;
use App\Models\Traits\HasCommonScopes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Neighbour extends Model
{
  use HasFactory, SoftDeletes, HasCommonScopes;

  protected $attributes = [
    'enable' => true
  ];

  protected $fillable = [
    'name', 'last_name', 'id_number',
    'phone', 'birthdate', 'enable',
    'address_notes'
  ];

  public function hood()
  {
    return $this->belongsTo(Hood::class);
  }

  public function address()
  {
    return $this->belongsTo(Address::class);
  }

  public function route()
  {
    return $this->belongsTo(Route::class);
  }

  public function notes()
  {
    return $this->hasMany(Note::class);
  }

  public function scopeByName($query)
  {
    return $query->orderBy('name')->orderBy('last_name');
  }

  public function scopeByRoute($query, Route $route=null)
  {
    if($route)
      return $query->where('route_id', $route->id);
    else
      return $query;
  }

  public function fullName(){
    return $this->name . ( $this->last_name ? " {$this->last_name}" : '' );
  }

  public function fullAddress()
  {
    return $this->address. ($this->hood ? ", {$this->hood->name}" : '');  
  }

  public function getBirthdateAttribute($value)
  {
    return $value ? Carbon::parse($value)->format('d/m/Y') : NULL;
  }

  public function setBirthdateAttribute($value)
  {
    return $this->attributes['birthdate'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : NULL;
  }

}
