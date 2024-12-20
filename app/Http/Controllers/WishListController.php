<?php

namespace App\Http\Controllers;

use App\Models\WishList;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller {
    public function addToWishList($productId) {
        $userId = Auth::id();

        $wishListItem = WishList::where('user_id', $userId)
        ->where('product_id', $productId)
        ->first();

        if ($wishListItem) {
            return redirect()->back()->with('success', 'Produkt jest już na twojej liście');
        }
        else {
            WishList::create([
            'user_id' => $userId,
            'product_id' => $productId,
            ]);
        }

        return redirect()->back()->with('success', 'Produkt został dodany do koszyka');
    }
}
