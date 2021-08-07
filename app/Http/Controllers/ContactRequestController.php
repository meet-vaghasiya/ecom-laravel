<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequestStoreRequest;
use App\Models\ContactRequest;
use Illuminate\Http\Request;

class ContactRequestController extends Controller
{

    public function index()
    {
        $contactRequests = ContactRequest::latest()->get();
        return view('admin.contact-request.index', compact('contactRequests'));
    }

    public function store(ContactRequestStoreRequest $request)
    {
        $contact = ContactRequest::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        return redirect()->route('admin.contact-request.index')->with('succes', 'contact added successfully');
    }


    public function delete($id)
    {
        $contactRequest = ContactRequest::destroy($id);

        return redirect()->route('admin.contact-request.index')->with('succes', 'contact updated successfully');
    }
}
