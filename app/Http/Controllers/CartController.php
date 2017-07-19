<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Product;
use App\Mail\Order;

class CartController extends Controller
{
    public function index() 
    {
        $prod_id_add = strip_tags(Input::get('add'));
        if(isset($prod_id_add)) {
            if(Session::has('cart')) {
                if(!in_array($prod_id_add, Session::get('cart'))) {
                    Session::push('cart', $prod_id_add);
                }
            } else {
                Session::push('cart', $prod_id_add);
            }
        }
        $prod_id_rmv = strip_tags(Input::get('remove'));
        if(isset($prod_id_rmv)) {
            $cart = Session::get('cart');
            Session::put('cart', array_diff($cart, [$prod_id_rmv]));
        }
        Session::save();
        $cart = Session::get('cart');
        $products = Product::whereIn('id', $cart)->get();
        if(count($products)) {
            $prod_exist = true;
        } else {
            $prod_exist = false;
        }
        return view('cart.index', [
            'products' => $products,
            'prod_exist' => $prod_exist
        ]);
    }
    
    public function email(Request $request) 
    {
        $cart = Session::get('cart');
        $products = Product::whereIn('id', $cart)->get();
        $product_names = [];
        foreach($products as $product) {
            $product_names[] = $product->name;
        }
        $product_names = implode(", ", $product_names);
        if($product_names == "") {
            return redirect("/cart");
        }
        $this->validate($request, [
            'client' => 'required|min:3',
            'email' => 'required',
            'details' => 'required|min:10',
        ]);
        Session::put('cart', []);
        $client = strip_tags(request('client'));
        $email = strip_tags(request('email'));
        $details = strip_tags(request('details'));
        \Mail::to($email)->send(new Order($client, $email, $details, $product_names));
        return redirect("/?mail=1");
    }
}
