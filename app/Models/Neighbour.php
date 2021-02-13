<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Neighbour extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'name', 'id_number', 'address',
    'phone', 'birthdate', 'enable',
    'lat', 'lng', 'hood_id', 'address_notes'
  ];

    public function addresses()
    {
      return $this->hasMany(Address::class);
    }
  }
