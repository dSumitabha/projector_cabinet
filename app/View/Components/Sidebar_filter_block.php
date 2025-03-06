<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Sidebar_filter_block extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, array $specifications)
    {
        $this->title = $title;
        $this->specifications = $specifications;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar_filter_block',
        [
            'title' => $this->title,
           'specifications' => $this->specifications,
        ]
    );
    }
}
