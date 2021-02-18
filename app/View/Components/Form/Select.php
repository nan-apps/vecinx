<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Select extends Component
{
    
    public $label;
    public $name;
    public $selected;
    public $collection;
    public $placeholder;
    public $getNameFunc;
    public $cssClasses;

    function __construct($name, $label=NULL, $selected=NULL, $collection=NULL, $placeholder=NULL, $getNameFunc=NULL, $cssClasses=NULL)
    {
        $this->name = $name;
        $this->label = $label;
        $this->selected = $selected;
        $this->collection = $collection;
        $this->placeholder = $placeholder;
        $this->getNameFunc = $getNameFunc;
        $this->cssClasses = $cssClasses;
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
