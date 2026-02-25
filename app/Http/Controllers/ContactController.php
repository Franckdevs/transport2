<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'nom_complet' => 'required',
            'votre_email' => 'required|email',
            'votre_message' => 'required',
        ],[
            'nom_complet.required' => 'Le nom complet est obligatoire.',
            'votre_email.required' => 'L\'email est obligatoire.',
            'votre_email.email' => 'Veuillez entrer une adresse email valide.',
            'votre_message.required' => 'Le message est obligatoire.',
        ]);
        $contact = new Contact();
        $contact->nom_complet = $request->nom_complet;
        $contact->votre_email = $request->votre_email;
        $contact->votre_message = $request->votre_message;
        $contact->save();
        $request->session()->flash('successs', 'Message envoyé avec succès.');
        return redirect()->back()->withFragment('contact-section');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
