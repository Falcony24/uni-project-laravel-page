<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ShopController extends Controller {
    public function showCategoryCatalog($categoryName){
        $category = Category::where('name', $categoryName)
            ->with(['subCategories.subCategoryImages'])
            ->firstOrFail();

        $subCategories = $category->subCategories;

        return view('shop.shopListSubCats', [
            'title' => $category->name,
            'subCategories' => $subCategories,
        ]);
    }
    public function showProductCatalog($category, $subCategory){
        return view('shop.shopListProducts', [
            'title' => $subCategory,
        ]);
    }
    public function showProduct($product){
        $productName = $product;
        $product = Product::with(['brand', 'subCategory', 'productImages'])
            ->where('name', $productName)
            ->firstOrFail();

        return view('shop.product', ['title' => $productName, 'product' => $product]);
    }
}
