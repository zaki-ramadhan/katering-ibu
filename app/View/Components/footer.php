<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Menu;

class footer extends Component
{
    public $menu;

    public function __construct()
    {
        $this->menu = Menu::all();
    }

    public function render()
    {
        return view('components.footer');
    }
}
