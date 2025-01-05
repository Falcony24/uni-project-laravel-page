<?php

namespace App\Http\Controllers;

class DeliveryController extends Controller{
    public function index(){

        return view('shop.cart', [
            'title' => 'AAA',
        ]);
    }
}
