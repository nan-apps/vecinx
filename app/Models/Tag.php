<?php

namespace App\Models;

use App\Models\Traits\HasCommonScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  use HasFactory, HasCommonScopes;

  public function notes()
  {
    return $this->belongsToMany(Note::class);
  }
}
