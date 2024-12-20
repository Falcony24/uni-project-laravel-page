<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DynamicCart extends Component{
    public bool $isGuest = false;
    public bool $isUser = false;
    public bool $isAdmin = false;
    public $cartTotal = 0;

    public function mount(){
        $this->isAdmin = Auth::check() && Auth::user()->isAdmin();
        $this->isUser = Auth::check();
        $this->isGuest = !($this->isAdmin && $this->isUser);

        if($this->isUser){
            $user = Auth::user();
            $cart = $user->cart;

            if ($cart) {
                $this->cartTotal = $cart->sum(function($product) {
                    return $product->quantity * $product->products->price;
                });
            }
        }
        elseif ($this->isGuest){
            $guestCart = json_decode(request()->cookie('guest_cart', '[]'), true);

            $this->cartTotal = collect($guestCart)->sum(function ($item) {
                $product = Product::find($item['product_id']);
                return $product ? $item['quantity'] * $product->price : 0;
            });
        }
    }

    public function render(){
        return view('livewire.shop.dynamic-cart');
    }
}
