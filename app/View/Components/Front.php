<?php

namespace App\View\Components;

use App\Models\Silder;
use Illuminate\View\Component;

class Front extends Component
{
    public $title;
    public $silders;
  
    public function __construct($title)
    {
        $this->title = $title;
        $this->silders = Silder::active()->date()->get();
        

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.front',[
            'title' => $this->title,
            'silders' => $this->silders,
        ]);
    }
}
