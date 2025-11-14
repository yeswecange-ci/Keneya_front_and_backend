<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function index()
    {
        $applications = ContactSubmission::where('type', 'application')
            ->orderBy('created_at', 'desc')
            ->get();
            
        $quotes = ContactSubmission::where('type', 'quote')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.contact.index', compact('applications', 'quotes'));
    }

    public function showApplication($id)
    {
        $application = ContactSubmission::where('type', 'application')->findOrFail($id);
        
        return response()->json([
            'id' => $application->id,
            'first_name' => $application->first_name,
            'last_name' => $application->last_name,
            'email' => $application->email,
            'phone' => $application->phone,
            'desired_position' => $application->desired_position,
            'availability_date' => $application->availability_date ? Carbon::parse($application->availability_date)->format('d/m/Y') : null,
            'cv_path' => $application->cv_path,
            'created_at' => $application->created_at->format('d/m/Y H:i'),
        ]);
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
            'created_at' => $quote->created_at->format('d/m/Y H:i'),
        ]);
    }

    public function downloadCv($id)
    {
        $application = ContactSubmission::where('type', 'application')->findOrFail($id);
        
        if (!Storage::exists($application->cv_path)) {
            abort(404, 'Fichier non trouvé');
        }

        $extension = pathinfo($application->cv_path, PATHINFO_EXTENSION);
        $filename = "CV_{$application->first_name}_{$application->last_name}.{$extension}";

        return Storage::download($application->cv_path, $filename);
    }

    public function destroy($id)
    {
        $submission = ContactSubmission::findOrFail($id);
        
        // Supprimer le fichier CV si c'est une candidature
        if ($submission->type === 'application' && $submission->cv_path) {
            Storage::delete($submission->cv_path);
        }
        
        $submission->delete();

        return redirect()->route('dashboard.contact')->with('success', 'Soumission supprimée avec succès.');
    }

    public function markAsRead($id)
    {
        $submission = ContactSubmission::findOrFail($id);
        $submission->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }
}