<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\SubCategory;
use Livewire\Component;

class DynamicProducts extends Component
{
    public $subCategoryName;
    public $products = [];
    public $perPage = 10;

    public $priceMin = null;
    public $priceMax = null;

    public function loadMore(){
        $this->perPage += 10;
        $this->fetchProducts();
    }
    public function a(){
        dd($this->subCategoryName);
}
    public function fetchProducts(){
        $subCategoryId = SubCategory::where('name', $this->subCategoryName)->value('id');

        if ($subCategoryId) {
            $query = Product::where('sub_category_id', $subCategoryId);

            if ($this->priceMin !== null) {
                $query->where('price', '>=', $this->priceMin);
            }

            if ($this->priceMax !== null) {
                $query->where('price', '<=', $this->priceMax);
            }

            $this->products = $query->take($this->perPage)->get();
        }
        else {
            $this->products = collect();
        }
    }

    public function mount($subCategoryName){
        $this->subCategoryName = $subCategoryName;
        $this->fetchProducts();
    }

    public function render(){
        return view('livewire.shop.dynamic-products');
    }
}
