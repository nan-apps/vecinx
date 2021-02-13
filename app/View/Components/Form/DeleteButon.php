<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class DeleteButon extends Component
{
    
    public $route;

    function __construct($route)
    {
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form.delete-buton');
    }
}
