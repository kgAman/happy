<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ContactCard extends Component
{
    public $icon;
    public $title;
    public $subtitle;
    public $mainText;
    public $description;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon = 'bi-telephone', $title = '', $subtitle = '', $mainText = '', $description = '')
    {
        $this->icon = $icon;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->mainText = $mainText;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.contact-card');
    }
}