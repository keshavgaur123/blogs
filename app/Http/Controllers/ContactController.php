<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // STORE CONTACT API
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'required|string|min:10',
        ]);

        // Validation Errors
        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Store Data
        $contact = Contact::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        // Success Response
        return response()->json([
            'status' => true,
            'message' => 'Message sent successfully!',
            'data' => $contact
        ]);
    }

    // GET ALL CONTACTS
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Contact::latest()->get()
        ]);
    }
}
