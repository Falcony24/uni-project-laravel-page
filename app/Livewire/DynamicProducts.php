<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\SubCategory;
use Livewire\Component;

class DynamicProducts extends Component{
    public $subCategoryName;
    public $products = [];
    public $perPage = 10;
    public $subCategoryId = null;
    public $count;

    public $priceMin = null;
    public $priceMax = null;

    protected $listeners = [
        'filters' => 'applyFilters',
    ];

    public function applyFilters($data, $data2) {
        $this->priceMin = $data[1];
        $this->priceMax = $data2[1] ;

        $this->fetchProducts();
    }
    public function loadMore(){
        $this->perPage += 10;
        $this->fetchProducts();
    }
    public function fetchProducts(){
        if ($this->subCategoryId) {
            $query = Product::where('sub_category_id', $this->subCategoryId);

            if ($this->priceMin !== null) {
                $query->where('price', '>=', $this->priceMin);
            }

            if ($this->priceMax !== null) {
                $query->where('price', '<=', $this->priceMax);
            }

            $this->products = $query->take($this->perPage)->get();
            $this->count = $this->products->count();
        }
        else {
            $this->products = collect();
            $this->count = 0;
        }
    }

    public function mount($subCategoryName){
        $this->subCategoryName = $subCategoryName;
        $this->subCategoryId = SubCategory::where('name', $this->subCategoryName)->value('id');
        $this->fetchProducts();
    }

    public function render(){
        return view('livewire.shop.dynamic-products');
    }
}
