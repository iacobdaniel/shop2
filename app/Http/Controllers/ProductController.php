<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Product;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    
    public function save(Request $request) 
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);
        $id = (int)request('id');
        if($id == 0) {
            $new_product = true;
        } else {
            $new_product = false;
        }
        $image = Input::file('image_upload');
        if(!isset($image) && $new_product) {
            return back()->withInput();
        }
        $upload_ok = true;
        if(isset($image)) {
            $extension = $image->getClientOriginalExtension();
            if(!($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg')) {
                $upload_ok = false;
            }
            $resize = false;
            if($image->getClientSize() > 200000) {
                $resize = true;
            }
        } else {
            $upload_ok = false;
        }
        if(!$upload_ok && $new_product) {
            return back()->withInput();
        }
        $name = strip_tags(request('name'));
        $description = strip_tags(request('description'));
        $price = (int)request('price');
        if($new_product) {
            $product = new Product;
            $product->name = $name;
            $product->description = $description;
            $product->price = $price;
            $product->save();
            $img_insert = Image::make($image->getRealPath());
            if($resize) {
                $img_insert->resize(1024, 768)->save(public_path() . '/images/' . (string)$product->id . '.' . $image->getClientOriginalExtension());
            } else {
                $img_insert->save(public_path() . '/images/' . (string)$product->id . '.' . $image->getClientOriginalExtension());
            }
        } else {
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
        }
        return redirect('/products'); 
    }
    
    public function delete($id) 
    {
        Product::where('id', $id)->delete();
        $old_images = glob('images/' . (string)$id . '.*');
        File::delete($old_images);
        return redirect('/products');
    }
    
    public function products() 
    {
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
    }
    
    public function edit($id) 
    {
        if($id == "new") {
            $prod_exist = false;
            $product = "";
        } else {
            $product = new Product;
            $product = Product::where('id', $id)->get()->first();
            if($product->count() != 0) {
                $prod_exist = true;
            } else {
                $prod_exist = false;
            }
        }
        return view('admin.edit', [
            'product' => $product,
            'prod_exist' => $prod_exist
        ]);
    }
}
