<?php

namespace App\Models;

use App\Models\Traits\HasCommonScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
  use HasFactory, HasCommonScopes;

  public function Addresses()
  {
    return $this->hasMany(Address::class);
  }
}
