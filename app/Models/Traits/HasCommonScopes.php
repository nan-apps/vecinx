<?php

namespace App\Models\Traits;

trait HasCommonScopes
{

  public function scopeEnable($query)
  {
    return $query->where('enable', 1);
  }

  public function scopeByName($query)
  {
    return $query->orderBy('name');
  }

  public function scopeByNewest($query)
  {
    return $query->orderByDesc('created_at');
  }

}
