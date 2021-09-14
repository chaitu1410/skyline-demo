<?php

namespace App\View\Components\admin;

use App\Models\Category;
use Illuminate\View\Component;

class EditCategory extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public Category $category;
    public function __construct(Category $category = null)
    {
        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.edit-category');
    }
}
