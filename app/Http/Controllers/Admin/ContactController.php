<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
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
}
