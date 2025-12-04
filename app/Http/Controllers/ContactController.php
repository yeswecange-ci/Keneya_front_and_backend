<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactSubmission;
use App\Models\ContactPage;

class ContactController extends Controller
{
    public function index()
    {
        $settings = ContactPage::first();

        return view('frontend.contact', compact('settings'));
    }

    public function storeApplication(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'desired_position' => 'required|string|max:255',
            'availability_date' => 'required|date',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048'
        ]);

        // Gestion du fichier CV
        $cvPath = $request->file('cv')->store('cvs');

        ContactSubmission::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'desired_position' => $validated['desired_position'],
            'availability_date' => $validated['availability_date'],
            'cv_path' => $cvPath,
            'type' => 'application'
        ]);

        return redirect()->back()->with('success', 'Votre candidature a été soumise avec succès!');
    }

    public function storeQuote(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        ContactSubmission::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'message' => $validated['message'],
            'type' => 'quote'
        ]);

        return redirect()->back()->with('success', 'Votre demande de devis a été soumise avec succès!');
    }
}
