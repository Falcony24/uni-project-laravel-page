<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller{
    public function addToCartGuest($productId){
        $cart = json_decode(request()->cookie('guest_cart', '[]'), true);

        $productIndex = collect($cart)->search(fn($item) => $item['product_id'] == $productId);

        if ($productIndex !== false) {
            $cart[$productIndex]['quantity']++;
        } else {
            $cart[] = [
                'product_id' => $productId,
                'quantity' => 1,
            ];
        }

        $cookie = cookie('guest_cart', json_encode($cart), 60 * 24 * 7);

        return redirect()->back()->withCookie($cookie)->with('success', 'Produkt został dodany do koszyka');
    }
    public function addToCart(Request $request, $productId){
        if ($request->isMethod('get')) {
            return redirect()->route('defaultPage');
        }

        if(!Auth::check()){
            return $this->addToCartGuest($productId);
        }

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }
        return redirect()->back()->with('success', 'Produkt został dodany do koszyka');
    }

    public static function syncGuestCartToUser(): void {
        $cart = json_decode(request()->cookie('guest_cart', '[]'), true);

        foreach ($cart as $item) {
            $cartItem = Cart::where('user_id', Auth::id())
                ->where('product_id', $item['product_id'])
                ->first();

            if ($cartItem) {
                $cartItem->increment('quantity', $item['quantity']);
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                ]);
            }
        }

        Cookie::queue(Cookie::forget('guest_cart'));
    }
    public function index(){
        return view('shop.cart', [
            'title' => 'Koszyk'
            ]);
    }
}
