<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;


class CartController extends Controller
{
    public function index()
    {
        return view('products.index');
    }


    public function cart()
    {
        return view('products.cart');
    }
    public function addToCart($id)
    {
        $cartItems = json_decode(request()->cookie('cart'),true)??[];
        if(isset($cartItems[$id]))
            $cartItems[$id] += 1;
        else
            $cartItems[$id] = 1;
        $cartItemsJsonString = json_encode($cartItems);
        Cookie::queue('cart', $cartItemsJsonString, 60*24*14);

        return back();
    }
    public function removeFromCart($id)
    {
        $cartItems = json_decode(request()->cookie('cart'),true)??[];
        unset($cartItems[$id]);
        $cartItemsJsonString = json_encode($cartItems);
        Cookie::queue('cart', $cartItemsJsonString, 60*24*14);
        return back();
    }
}
