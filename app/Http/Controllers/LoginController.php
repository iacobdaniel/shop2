<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Product;

class LoginController extends Controller
{
    public function index() 
    {
        $err_param = Input::get('error');
        if(isset($err_param)) {
            if($err_param == '1') {
                $error = true;
            } else {
                $error = false;
            }
        } else {
            $error = false;
        }
        if(Session::get('admin')) {
            return redirect('/admin');
        } else {
            return view('login.index', [
                'error' => $error
            ]);
        }
    }
    
    public function login(Request $request) 
    {
        $this->validate($request, [
            'user' => 'required',
            'password' => 'required'
        ]);
        $user = strip_tags(request('user'));
        $password = strip_tags(request('password'));
        if(ADMIN_USER == $user && ADMIN_PASS == $password) {
            Session::put('admin', true);
        } else {
            Session::put('admin', false);
        }
        Session::save();
        if(Session::get('admin')) {
            return redirect('/admin');
        } else {
            return redirect('/login?error=1');
        }
    }
    
    public function logout() 
    {
        Session::put('admin', false);
        Session::save();
        return redirect('/login');
    }
}
