<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Select extends Component
{
    
    public $label;
    public $name;
    public $selected;
    public $collection;

    function __construct($label, $name, $selected=NULL, $collection=NULL)
    {
        $this->label = $label;
        $this->name = $name;
        $this->selected = $selected;
        $this->collection = $collection;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form.select');
    }
}
