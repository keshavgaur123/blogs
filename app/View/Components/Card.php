<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public $id;
    public $title;
    public $image;
    public $description;

    public function __construct($id, $title, $image, $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->image = $image;
        $this->description = $description;
    }

    public function render()
    {
        return view('components.card');
    }
}