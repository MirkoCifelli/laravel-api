<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Contact;

class ContactController extends Controller
{

    public function index()
    {
        $contactsQuery = Contact::select('*');
 
        $queryStringParams = request()->all();

        if (isset($queryStringParams['name'])) {
            $contactsQuery->where('name', 'LIKE', '%'.$queryStringParams['name'].'%');
        }

        if (isset($queryStringParams['email'])) {
            $contactsQuery->where('email', 'LIKE', '%'.$queryStringParams['email'].'%');
        }

        $contacts = $contactsQuery->get();

        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index');
    }

}
