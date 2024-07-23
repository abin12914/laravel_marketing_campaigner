<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Imports\ContactsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Query\Builder;
use App\Http\Requests\StoreContactRequest;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $contacts = Contact::when((!empty($request->search)), function (Builder $query, $request) {
            $query->where('username', 'LIKE', $request->search);
        })->withCount('notificationHistory')->paginate($request->limit ?? 10);
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)//: RedirectResponse
    {
        Contact::create($request->validated());
        return redirect(route('contacts.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact): View
    {
        return view('contacts.edit', [
            'contact' => $contact,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact): RedirectResponse
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
        ]);
 
        $contact->update($validated);
 
        return redirect(route('contacts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();
        return redirect(route('contacts.index'));
    }

    /**
     * Import the contacts excel sheet to db.
     */
    public function importContacts(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'contacts_file' => 'required|file|extensions:xlsx',
        ]);
        Excel::import(new ContactsImport, $request->file('contacts_file'), null, \Maatwebsite\Excel\Excel::XLSX);
        
        return redirect(route('contacts.index'))->with('success', 'All good!');
    }

    
}
