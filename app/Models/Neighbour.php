<?php

namespace App\Models;

use App\Models\Hood;
use App\Models\Traits\HasCommonScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Neighbour extends Model
{
  use HasFactory, SoftDeletes, HasCommonScopes;

  protected $fillable = [
    'name', 'last_name', 'id_number', 'address',
    'phone', 'birthdate', 'enable',
    'lat', 'lng', 'hood_id', 'address_notes'
  ];

  public function hood()
  {
    return $this->belongsTo(Hood::class);
  }

  public function addresses()
  {
    return $this->hasMany(Address::class);
  }

  public function notes()
  {
    return $this->hasMany(Note::class);
  }

  public function scopeByName($query)
  {
    return $query->orderBy('name')->orderBy('last_name');
  }

  public function fullName(){
    return $this->name . ( $this->last_name ? " {$this->last_name}" : '' );
  }

  public function fullAddress()
  {
    return $this->address. ($this->hood ? ", {$this->hood->name}" : '');  
  }

}
