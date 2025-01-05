<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FinalCart extends Component{
    public $cartItems = [];
    public $cartTotal = 0;
    public $canEdit = true;
    public $user;
    public function mount(){
        $this->user = Auth::user();
        $this->loadCart();
    }

    public function loadCart(){
        $this->cartItems = [];
        $this->cartTotal = 0;

        if (Auth::check()) {
            $cart = $this->user->cart;

            $this->cartItems = $cart->map(function ($cartItem) {
                $quantity = $cartItem->quantity;
                $product = $cartItem->products;
                return [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'total' => $quantity * $product->price,
                ];
            });

            $this->cartTotal = $this->cartItems->sum('total');
        } else {
            $guestCart = json_decode(request()->cookie('guest_cart', '[]'), true);

            $productIds = collect($guestCart)->pluck('product_id');
            $products = Product::whereIn('id', $productIds)->get();

            $this->cartItems = collect($guestCart)->map(function ($item) use ($products) {
                $product = $products->firstWhere('id', $item['product_id']);
                if ($product) {
                    return [
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => $item['quantity'],
                        'total' => $item['quantity'] * $product->price,
                    ];
                }
                return null;
            })->filter();

            $this->cartTotal = $this->cartItems->sum('total');
        }
    }

    public function updateQuantity($productId, $quantity){
        $quantity = max(0, $quantity);

        if (Auth::check()) {
            $cartItem = $this->user->cart()->where('product_id', $productId)->first();

            if ($cartItem) {
                if ($quantity == 0) {
                    $cartItem->delete();
                } else {
                    $cartItem->update([
                        'quantity' => $quantity,
                        'total' => $cartItem->price * $quantity,
                    ]);
                }
            }

            $this->loadCart();
        } else {
            $guestCart = json_decode(request()->cookie('guest_cart', '[]'), true);

            foreach ($guestCart as &$item) {
                if ($item['product_id'] == $productId) {
                    if ($quantity == 0) {
                        $item = null;
                    } else {
                        $item['quantity'] = $quantity;
                        $item['total'] = $item['quantity'] * $item['price'];
                    }
                    break;
                }
            }

            $guestCart = array_filter($guestCart);

            cookie()->queue(cookie()->forever('guest_cart', json_encode($guestCart)));

            $this->loadCart();
        }

        $this->dispatch('refresh');
    }

    public function lockCart(){
        $this->canEdit = false;
    }

    public function render(){
        return view('livewire.shop.final-cart');
    }
}
