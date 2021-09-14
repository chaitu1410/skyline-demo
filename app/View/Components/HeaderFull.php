<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;

class HeaderFull extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data['categories'] = Category::all()->take(10);
        return view('components.header-full', $data);
    }
}
