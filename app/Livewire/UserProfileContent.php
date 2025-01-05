<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\WishList;
use http\Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use function PHPUnit\Framework\throwException;

class UserProfileContent extends Component{
    public $user;
    public $user_id;
    public $wishListItems = null;
    public $addresses = null;
    public $opt;
    public $content = [];

    public function profile(){
        if(is_null($this->user)) {
            $this->user = Auth::user()->only(['name', 'surname', 'email']);
            $this->user_id = Auth::id();
        }

        $this->content['title'] = 'Profil';
        $this->content['items'] = $this->user;
    }
    public function wishList(){
        if(is_null($this->wishListItems)) {
            $productIds = WishList::where('user_id', $this->user_id)->pluck('product_id');
            $this->wishListItems = Product::whereIn('id', $productIds)
                ->select('id', 'name')
                ->get()
                ->toArray();
        }

        $this->content['title'] = 'Lista życzeń';
        $this->content['items'] = $this->wishListItems;
    }
    public function addresses(){
        $this->content['title'] = 'Adresy';
    }
    public function loadData($opt) {
        $this->opt = $opt;

        switch ($opt) {
            case 'wishList':
                $this->wishList();
                break;
            case 'addresses':
                //user-addresses livewire
                $this->addresses();
                break;
            case 'profile':
                $this->profile();
                break;
            default:
                $this->content = ['title' => 'Nieznana opcja', 'items' => []];
        }
    }
    public function removeFromWishList($productId){
        $wishlistItem = Wishlist::where('product_id', $productId)->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
        }
    }
    public function mount(){
        $this->loadData('profile');
    }

    public function render(){
        return view('livewire.user.user-profile-content');
    }
}
