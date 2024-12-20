<?php

namespace App\Livewire;

use App\Models\SubCategory;
use Livewire\Component;

class DynamicCategories extends Component {
    public $categories;

    public function mount(){
        $subcategories = SubCategory::with('category')->get();

        $this->categories = [];

        foreach ($subcategories as $subcategory) {
            $categoryId = $subcategory->category->id;

            if (!isset($this->categories[$categoryId])) {
                $this->categories[$categoryId] = [
                    'category' => $subcategory->category,
                    'subcategories' => []
                ];
            }

            $this->categories[$categoryId]['subcategories'][] = $subcategory;
        }
    }

    public function render(){
        return view('livewire.shop.dynamic-categories');
    }
}
