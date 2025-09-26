<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    // Afficher la gestion des CV
    public function cv()
    {
        $cvs = Document::where('type', 'cv')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('internships.documents.cv', compact('cvs'));
    }

    // Uploader un CV
    public function uploadCv(Request $request)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048'
        ]);

        $file = $request->file('cv');
        $fileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs('private/documents/cv', $fileName);

        Document::create([
            'user_id' => Auth::id(),
            'type' => 'cv',
            'file_name' => $fileName,
            'path' => $path
        ]);

        return redirect()->back()->with('success', 'CV téléchargé avec succès !');
    }

    // Télécharger un document (générique)
    public function download(Document $document)
    {
        // Vérifier les autorisations
        abort_unless($document->user_id == Auth::id() || Auth::user()->hasRole('admin'), 403);

        if (!Storage::exists($document->path)) {
            abort(404);
        }

        return Storage::download($document->path, $document->file_name);
    }

    // Gestion des conventions de stage
    public function convention()
    {
        $conventions = Document::where('type', 'convention')
            ->whereHas('internship', function($query) {
                $query->where('tutor_id', Auth::id());
            })
            ->get();

        return view('internships.documents.convention', compact('conventions'));
    }

    // Gestion des rapports de stage
    public function report()
    {
        $reports = Document::where('type', 'report')
            ->whereHas('internship', function($query) {
                $query->where('intern_id', Auth::id());
            })
            ->get();

        return view('internships.documents.report', compact('reports'));
    }

    // Uploader un rapport
    public function uploadReport(Request $request, Internship $internship)
    {
        $request->validate([
            'report' => 'required|file|mimes:pdf,docx|max:5120'
        ]);

        $file = $request->file('report');
        $fileName = "Rapport-". $internship->id . "-" . now()->format('YmdHis') . "." . $file->getClientOriginalExtension();

        $path = $file->storeAs('private/documents/reports', $fileName);

        Document::create([
            'internship_id' => $internship->id,
            'type' => 'report',
            'file_name' => $fileName,
            'path' => $path
        ]);

        return redirect()->back()->with('success', 'Rapport déposé avec succès !');
    }
}