<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Header extends Component
{
    public $title = 'Untitled';
    public $description;

    /**
     * Create a new component instance.
     *
     * @param $title
     * @param $description
     */
    public function __construct($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.header');
    }
}
