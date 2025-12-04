<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use App\Models\ContactPage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $quotes = ContactSubmission::where('type', 'quote')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.contact.index', compact('quotes'));
    }

    public function showQuote($id)
    {
        $quote = ContactSubmission::where('type', 'quote')->findOrFail($id);

        return response()->json([
            'id' => $quote->id,
            'first_name' => $quote->first_name,
            'last_name' => $quote->last_name,
            'email' => $quote->email,
            'phone' => $quote->phone,
            'message' => $quote->message,
            'created_at_formatted' => $quote->created_at->format('d/m/Y H:i'),
        ]);
    }

    public function markAsRead($id)
    {
        $submission = ContactSubmission::findOrFail($id);
        $submission->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }

    public function markAsUnread($id)
    {
        $submission = ContactSubmission::findOrFail($id);
        $submission->update(['read_at' => null]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $submission = ContactSubmission::findOrFail($id);
        $submission->delete();

        return redirect()->route('dashboard.contact')->with('success', 'Demande de devis supprimée avec succès.');
    }

    public function export()
    {
        $quotes = ContactSubmission::where('type', 'quote')
            ->orderBy('created_at', 'desc')
            ->get();

        $filename = 'devis_' . now()->format('Y-m-d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($quotes) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($file, [
                'Date',
                'Prénom',
                'Nom',
                'Email',
                'Téléphone',
                'Message',
                'Statut'
            ], ';');

            foreach ($quotes as $quote) {
                fputcsv($file, [
                    $quote->created_at->format('d/m/Y H:i'),
                    $quote->first_name,
                    $quote->last_name,
                    $quote->email,
                    $quote->phone,
                    $quote->message,
                    $quote->read_at ? 'Lu' : 'Non lu'
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function editSettings()
    {
        $settings = ContactPage::first();

        if (!$settings) {
            $settings = ContactPage::create([]);
        }

        return view('admin.contact.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'text_above_image_fr' => 'nullable|string',
            'text_above_image_en' => 'nullable|string',
            'text_above_image_es' => 'nullable|string',
            'location_url' => 'nullable|string',
            'location_text_fr' => 'nullable|string',
            'location_text_en' => 'nullable|string',
            'location_text_es' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $settings = ContactPage::first();

        if (!$settings) {
            $settings = ContactPage::create([]);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('img'), $imageName);
            $validated['image'] = 'img/' . $imageName;
        }

        $settings->update($validated);

        return redirect()->route('dashboard.contact.settings')->with('success', 'Paramètres de la page de contact mis à jour avec succès.');
    }
}
