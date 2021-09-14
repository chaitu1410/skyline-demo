<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;

class CategoriesList extends Component
{

    public $query;
    public $showModal = false;

    public function __construct($query = "") {
        $this->query = $query;
    }

    public function onEditClick($id){
         $this->showModal = !$this->showModal; 
        //     $this->showModal = "true";
        //  }else{
        //     $this->showModal = "false";
        //  }
    }

    public function render()
    {
        $data['categories'] = Category::all();
        return view('livewire.admin.categories-list', $data);
    }
}
