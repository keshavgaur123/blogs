<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class ContactController extends Controller
// {
//     //
// }


namespace App\Http\Controllers;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }
}
