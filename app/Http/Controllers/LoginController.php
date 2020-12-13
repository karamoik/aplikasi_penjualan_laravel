<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){

        if (auth()->user()) {
            
            return redirect()->route('admin');
        }
        

        return view('login');
    }

    public function authenticate(){
        $data = [
            'email'=> request('email'),
            'password'=> request('password'),
        ];

        Auth::attempt($data);
        if (Auth::check()){
            return redirect()->route('admin');
        }

        Session()->flash('message','Email Atau Password Salah');
        return redirect ()->route('login');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
