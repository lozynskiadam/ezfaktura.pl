<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Bell extends Component
{
    public $number;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->number = count(Auth::user()->notifications()->where('is_confirmed', '0')->get());
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.bell');
    }
}
