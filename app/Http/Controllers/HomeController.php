<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Product;

class HomeController extends Controller
{
    public function index() 
    {
        $lang = Input::get('lang');
        if(isset($lang)) {
            $languages = explode(',', LANGUAGES);
            if(in_array($lang, $languages)) {
                Session::put('lang', $lang);
            } else {
                Session::put('lang', 'en');
            }
        } else {
            Session::put('lang', 'en');
        }
        Session::save();
        
        $order_mail = Input::get('mail');
        if(isset($order_mail)) {
            if($order_mail == '1') {
                $order_mail = true;
            } else {
                $order_mail = true;
            }
        }
        $cart = Session::get('cart');
        if(!isset($cart)) {
            $products = Product::all();
        } else {
            $products = Product::whereNotIn('id', $cart)->get();
        }
        if(count($products)) {
            $prod_exist = true;
        } else {
            $prod_exist = false;
        }
        return view('products.index', [
            'products' => $products,
            'prod_exist' => $prod_exist,
            'lang' => Session::get('lang'),
            'order_mail' => $order_mail
        ]);
    }
}
