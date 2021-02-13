<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Fa extends Component
{
  public $color;

  public function __construct($color=NULL)
  {
    $this->color = $color;
  }

  public function render()
  {
    return view('components.fa');
  }
}
