<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() {
        return view('register', [
            'title' => 'register'
        ]);
        
    }
    // public function store(Request $request)
    public function store()
    {
        return request();
    }
}
