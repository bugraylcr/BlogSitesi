<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactAdminController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->get();
        return view('admin.contacts.index', compact('messages'));
    }

    public function destroy(ContactMessage $contact)
    {
        $contact->delete();
        return back()->with('status', 'Mesaj silindi.');
    }
}


