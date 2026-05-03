<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class ContactController extends Controller
// {
//     //
// }


// namespace App\Http\Controllers;

// class ContactController extends Controller
// {
//     public function index()
//     {
//         return view('contact');
//     }
// }


use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}