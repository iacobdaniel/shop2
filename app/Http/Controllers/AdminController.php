<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Product;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{
    public function index() {
        if(Session::get('admin')) {
            return view('admin.index');
        } else {
            return redirect('/login');
        }
    }
    
    public function products() {
        if(Session::get('admin')) {
            $products = Product::all();
            if(count($products)) {
                $prod_exist = true;
            } else {
                $prod_exist = false;
            }
            return view('admin.products', [
                'products' => $products,
                'prod_exist' => $prod_exist
            ]);
        } else {
            return redirect('/login');
        }
    }
    
    public function create() {
        if(Session::get('admin')) {
            return view('admin.create');
        } else {
            return redirect('/login');
        }
    }
    
    public function edit($id) {
        if(Session::get('admin')) {
            $product = new Product;
            $product = Product::where('id', $id)->get();
            if($product->count() != 0) {
                $prod_exist = true;
            } else {
                $prod_exist = false;
            }
            return view('admin.edit', [
                'product' => $product->first(),
                'id' => $id,
                'prod_exist' => $prod_exist
            ]);
        } else {
            return redirect('/login');
        }
    }
    
    public function new_product() {
        if(Session::get('admin')) {
            $product = new Product;
            $image = Input::file('image_upload');
            if(!isset($image) || strip_tags(request('name')) == '' || strip_tags(request('price')) == '' || strip_tags(request('description')) == '') {
                return back()->withInput();
            }
            $upload_ok = true;
            $extension = $image->getClientOriginalExtension();
            if($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg') {
            } else {
                $upload_ok = false;
            }
            $resize = false;
            if($image->getClientSize() > 200000) {
                $resize = true;
            }
            $product->name = strip_tags(request('name'));
            $product->description = strip_tags(request('description'));
            $product->price = (int)request('price');
            $product->save();
            if($upload_ok) {
                $img_insert = Image::make($image->getRealPath());
                if($resize) {
                    $img_insert->resize(1024, 768)->save(public_path() . '/images/' . (string)$product->id . '.' . $image->getClientOriginalExtension());
                } else {
                    $img_insert->save(public_path() . '/images/' . (string)$product->id . '.' . $image->getClientOriginalExtension());
                }
            }
            return redirect('/products'); 
        } else {
            return redirect('/login');
        }
    }
    
    public function patch_product() {
        if(Session::get('admin')) {
            $image = Input::file('image_upload');
            $name = strip_tags(request('name'));
            $price = (int)request('price');
            $description = strip_tags(request('description'));
            $id = (int)request('id');
            if($name == '' || strip_tags(request('price')) == '' || $price == '' || $description == '') {
                return back()->withInput();
            }
            $upload_ok = true;
            if(isset($image)) {
                $extension = $image->getClientOriginalExtension();
                if($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg') {
                    
                } else {
                    $upload_ok = false;
                }
                $resize = false;
                if($image->getClientSize() > 200000) {
                    $resize = true;
                }
            } else {
                $upload_ok = false;
            }
            
            Product::where('id', $id)->update([
                'name' => $name,
                'description' => $description,
                'price' => $price
            ]);
            if($upload_ok) {
                $img_insert = Image::make($image->getRealPath());
                $old_images = glob('images/' . (string)$id . '.*');
                File::delete($old_images);
                if($resize) {
                    $img_insert->resize(1024, 768)->save(public_path() . '/images/' . (string)$id . '.' . $image->getClientOriginalExtension());
                } else {
                    $img_insert->save(public_path() . '/images/' . (string)$id . '.' . $image->getClientOriginalExtension());
                }
            }
            return redirect('/products'); 
        } else {
            return redirect('/login');
        }
    }
}
