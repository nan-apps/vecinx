<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class ButtonsSwtich extends Component
{
    
    public $label;
    public $name;
    public $collection;
    public $selected;
    public $size;
    public $allButton;
    public $inputClasses;

    function __construct($label, $name, $collection, $selected, $size=null, $allButton=null, $inputClasses=null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->collection = $collection;
        $this->selected = $selected;
        $this->size = $size;
        $this->allButton = $allButton;
        $this->inputClasses = $inputClasses;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form.buttons-switch');
    }
}
