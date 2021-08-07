<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\ContactRequest;
use App\Http\Requests\Contact\ContactUpdateRequest;
use App\Models\AdminContact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{

    public function index()
    {
        $adminContacts = AdminContact::latest()->get();
        return view('admin-contact.index', compact('adminContacts'));
    }

    public function store(ContactRequest $request)
    {
        $contact = AdminContact::create([
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email
        ]);

        return redirect()->route('admin.contact.index')->with('succes', 'contact added successfully');
    }

    public function edit(Request $request, $id)
    {
        $adminContact = AdminContact::findOrFail($id);
        return view('admin-contact.edit', compact('adminContact'));
    }

    public function update(ContactUpdateRequest $request, $id)
    {
        $adminContact = AdminContact::findOrFail($id);
        $adminContact->address = $request->address;
        $adminContact->email = $request->email;
        $adminContact->phone = $request->phone;
        $adminContact->save();

        return redirect()->back()->with('success', 'contact updated successfully');
    }

    public function delete($id)
    {
        $adminContact = AdminContact::destroy($id);

        return redirect()->route('admin.contact.index')->with('succes', 'contact updated successfully');
    }
}
