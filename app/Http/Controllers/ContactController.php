<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'requrired|string|min:10',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
        ]);

        $contact = Contact::create($validated);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'id' => $contact->id]);
        }

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}

