<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class CheckBox extends Component
{
    
    public $label;
    public $name;
    public $old;
    public $mode;
    public $value;

    function __construct($label, $name, $checked=NULL, $value=NULL)
    {
        $this->label = $label;
        $this->name = $name;
        $this->checked = $checked;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form.check-box');
    }

    public function checked()
    {
        return !empty($this->checked);
    }
}
