<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show contact page (Blade view)
     */
    public function index()
    {
        return view('contact.view');
    }

    /**
     * Data for DataTables (AJAX JSON)
     */
    public function getContacts()
    {
        return response()->json([
            'data' => Contact::latest()->get()
        ]);
    }

    /**
     * Store contact form data
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'title' => 'required',
            'description' => 'required'
        ]);

        $contact = Contact::create($request->only([
            'name',
            'email',
            'title',
            'description'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Message sent successfully',
            'data' => $contact
        ]);
    }
}
