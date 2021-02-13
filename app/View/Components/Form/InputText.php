<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class InputText extends Component
{
    
    public $label;
    public $name;
    public $value;
    public $mode;

    function __construct($label, $name, $value=NULL, $mode=NULL)
    {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->mode = $mode;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form.input-text');
    }
}
