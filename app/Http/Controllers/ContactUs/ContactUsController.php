<?php

namespace App\Http\Controllers\ContactUs;

use App\Http\Controllers\Controller;
use App\Model\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller {
    /* Show All Contacts */
    public function index(){
        $Contacts = ContactUs::orderBy('created_at', 'desc')->paginate(12)->onEachSide(2);
        return view('admin.contacts.index', compact('Contacts'));
    }

    /* Show Contact Us Page */
    public function show() {
        return view('site.pages.contact-us');
    }

    /* Submit Contact */
    public function store(Request $request) {
        $ContactUsMeta = (array)$request->all();
        $ContactUsMeta['status'] = 'new';
        if (ContactUs::create($ContactUsMeta)) {
            return redirect()->back()->with('notification', [
                'class' => 'success',
                'message' => 'Your message has been successfully registered and we will contact you shortly.'
            ]);
        }
    }

    /* Edit Contact */
    public function edit($id) {
        $Contact = ContactUs::find($id);
        return view('admin.contacts.edit', compact('Contact'));
    }

    /* Contact Destroy */
    public function destroy(Request $request) {
        $this->middleware('can:isAuthor');
        foreach ($request->delete_item as $key => $item) {
            ContactUs::where('id', $key)->delete();
        }

        return redirect('/dashboard/contacts')->with('notification', [
            'class' => 'success',
            'message' => 'Item is Delete.'
        ]);
    }
}
