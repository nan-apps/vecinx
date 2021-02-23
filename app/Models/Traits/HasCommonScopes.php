<?php

namespace App\Models\Traits;

trait HasCommonScopes
{

  public function scopeEnable($query)
  {
    return $query->where("{$this->getTable()}.enable", 1);
  }

  public function scopeByName($query)
  {
    return $query->orderBy("{$this->getTable()}.name");
  }

  public function scopeByNewest($query)
  {
    return $query->orderByDesc("{$this->getTable()}.created_at");
  }

}
