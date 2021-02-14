<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class InputText extends Component
{
    
    public $label;
    public $name;
    public $value;
    public $mode;
    public $placeholder;

    function __construct($label, $name, $value=NULL, $mode=NULL, $placeholder=NULL)
    {
        $this->label = $label;
        $this->name = $name;
        $this->mode = $mode;
        $this->value = $value;
        $this->placeholder = $placeholder;
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


    public function type()
    {
        if($this->mode == 'date')
            return 'text';
        elseif ($this->mode && $this->mode != 'text' )
            return $this->mode;
        else
            return 'text';
    }
}
