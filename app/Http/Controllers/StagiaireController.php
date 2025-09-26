<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stagiaire;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\StagiairesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Tuteur;
use Illuminate\Support\Facades\Auth;


class StagiaireController extends Controller
{
    public function index()
    {
        Log::info('Fetching stagiaires list');
        
        $stagiaires = Stagiaire::with('user')->whereHas('user', function ($query) {
            $query->role('stagiaire');
        })->paginate(10);

        $stagiairesAffectes = Stagiaire::with('user', 'tuteur')
            ->whereNotNull('tutor_id')
            ->paginate(10);
        
        if ($stagiaires->isEmpty()) {
            Log::info('No stagiaires found');
            return view('stagiaires.index', ['stagiaires' => $stagiaires, 'stagiairesAffectes' => $stagiairesAffectes, 'message' => 'Aucun stagiaire trouvé.']);
        }
        
        return view('stagiaires.index', compact('stagiaires', 'stagiairesAffectes'));
    }

    public function create()
    {
        return view('stagiaires.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'nullable|string|min:8|confirmed',
                'entreprise' => 'nullable|string|max:255',
                'statut' => 'required|in:En attente,En cours,Terminé',
                'cv' => 'nullable|file|mimes:pdf,docx|max:10240', // CV doit être un fichier PDF ou DOCX de moins de 10 Mo
                'institution' => 'nullable|string|max:255',
                
            ]);

            // Création de l'utilisateur
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            // Attribution du rôle "stagiaire"
            $user->assignRole('stagiaire');

            // Traitement du CV si présent
            $cvPath = null;
            if ($request->hasFile('cv')) {
                $cvPath = $request->file('cv')->store('cv'); // Stockage du CV dans le répertoire 'cv'
            }

            // Création du stagiaire lié
            $stagiaire = Stagiaire::create([
                'user_id' => $user->id,
                'entreprise' => $request->entreprise,
                'statut' => $request->statut,
                'institution' => $request->institution,
                'cv' => $cvPath, // Enregistrement du chemin du CV dans la base de données
            ]);

            Log::info('Stagiaire created successfully', ['user_id' => $user->id]);

            return redirect()->route('stagiaires.index')->with('success', 'Stagiaire ajouté avec succès.');

        } catch (\Exception $e) {
            Log::error('Erreur lors de la création du stagiaire : ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue : ' . $e->getMessage()])->withInput();
        }
    }

    public function show($id)
    {
        $stagiaire = Stagiaire::findOrFail($id);
        return view('stagiaires.show', compact('stagiaire'));
    }

    public function edit($id)
{
    $stagiaire = Stagiaire::with('user')->findOrFail($id);

    if (Auth::user()->role === 'stagiaire' && Auth::id() !== $stagiaire->user_id) {
        abort(403, 'Accès refusé');
    }

    $entreprises = [];
    if (Auth::user()->role === 'admin') {
        $entreprises = Entreprise::all();
    }

    return view('stagiaires.edit', compact('stagiaire', 'entreprises'));
}



    public function update(Request $request, $id)
{
    $stagiaire = Stagiaire::findOrFail($id);
    $user = $stagiaire->user;

    $isStagiaire = Auth::user()->role === 'stagiaire';

    // Validation commune
    $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'cv' => 'nullable|mimes:pdf|max:2048',
    ];

    // Si c’est un admin, on valide aussi entreprise et statut
    if (!$isStagiaire) {
        $rules['entreprise_id'] = 'nullable|exists:entreprises,id';
        $rules['statut'] = 'nullable|in:en attente,validé,refusé';
    }

    $validated = $request->validate($rules);

    // Mise à jour des infos user
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->save();

    // Si admin => modifier aussi entreprise/statut
    if (!$isStagiaire) {
        $stagiaire->entreprise_id = $request->entreprise_id;
        $stagiaire->statut = $request->statut;
    }

    // CV
    if ($request->hasFile('cv')) {
        $filename = time() . '_' . $request->file('cv')->getClientOriginalName();
        $path = $request->file('cv')->storeAs('cvs', $filename, 'public');
        $stagiaire->cv = $filename;
    }

    $stagiaire->save();

    return redirect()->back()->with('success', 'Informations mises à jour avec succès.');
}


    public function destroy($id)
    {
        try {
            $stagiaire = Stagiaire::findOrFail($id);
            $user = $stagiaire->user; // Récupérer l'utilisateur associé

            // Supprimer le CV s'il existe
            if ($stagiaire->cv) {
                Storage::delete($stagiaire->cv);
            }

            if ($user) {
                $user->delete(); // Supprimer l'utilisateur
            }

            $stagiaire->delete(); // Supprimer le stagiaire

            Log::info('Stagiaire and associated user deleted successfully', ['stagiaire_id' => $id, 'user_id' => $user->id]);

            return redirect()->route('stagiaires.index')->with('success', 'Stagiaire et utilisateur supprimés avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression du stagiaire : ' . $e->getMessage());
            return redirect()->route('stagiaires.index')->withErrors(['error' => 'Une erreur est survenue lors de la suppression.']);
        }
    }


    public function exportExcel()
{
    return Excel::download(new StagiairesExport, 'stagiaires.xlsx');
}

public function exportPDF()
{
    $stagiaires = Stagiaire::with('user')->get();
    $pdf = Pdf::loadView('stagiaires.pdf', compact('stagiaires'));
    return $pdf->download('stagiaires.pdf');
}
}
