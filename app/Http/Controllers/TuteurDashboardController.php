<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Stage;
use App\Models\Rapport;
use Illuminate\Support\Facades\Auth;

class TuteurDashboardController extends Controller

{ public function dashboard()
    {
        // Récupérer les stages des stagiaires affectés au tuteur connecté
        $stages = Stage::with(['stagiaire', 'entreprise', 'rapports'])
            ->where('tutor_id', Auth::id()) // Récupère les stages affectés au tuteur connecté
            ->get();

        return view('dashboard_tuteur', compact('stages'));
    }

    public function showStagiaire(Stage $stage)
    {
        // Vérifier si le tuteur connecté est bien responsable de ce stagiaire
        if ($stage->tutor_id !== Auth::id()) {
            return redirect()->route('dashboard_tuteurs')->with('error', 'Accès non autorisé.');
        }

        return view('stagiaire_show', compact('stage'));
    }

    public function ajouterRapport(Request $request, Stage $stage)
    {
        // Valider la requête
        $request->validate([
            'contenu' => 'required|file|mimes:pdf|max:10240', // Limite la taille à 10MB
            'date' => 'required|date',
        ]);

        // Gérer l'upload du fichier PDF
        $file = $request->file('contenu'); // Récupère le fichier PDF
        $filePath = $file->store('rapports'); // Stocke le fichier dans le dossier 'rapports' dans le stockage

        // Créer un nouvel enregistrement de rapport
        Rapport::create([  // Remplace "Rapports" par "Rapport"
            'stage_id' => $stage->id,
            'contenu' => $filePath, // Sauvegarde le chemin du fichier
            'date' => $request->date,
        ]);

    return redirect()->route('stagiaire_show', $stage->id)->with('success', 'Rapport ajouté avec succès.');
}
public function evaluerStage(Request $request, Stage $stage)
    {
        // Valider la requête
        $request->validate([
            'note' => 'required|integer|min:0|max:20',
            'commentaire' => 'nullable|string',
        ]);

        // Créer l'évaluation
        Evaluation::create([
            'stage_id' => $stage->id,
            'tuteur_id' => Auth::id(), // L'ID du tuteur connecté
            'note' => $request->note,
            'commentaire' => $request->commentaire,
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('stagiaire_show', $stage->id)->with('success', 'Évaluation soumise avec succès.');
    }
    public function store(Request $request, $stageId)
    {
        $request->validate([
            'note' => 'required|numeric|min:0|max:20',
            'commentaire' => 'required|string|max:1000',
        ]);

        // Trouver le stage
        $stage = Stage::findOrFail($stageId);

        // Créer une nouvelle évaluation
        Evaluation::create([
            'stage_id' => $stage->id,
            'tuteur_id' => Auth::id(), // L'ID du tuteur actuel
            'note' => $request->note,
            'commentaire' => $request->commentaire,
        ]);

        return redirect()->route('stagiaire_show', $stage->id)->with('success', 'Évaluation soumise avec succès.');
    }

    public function mesStagiaires()
{
    $tuteur = Auth::user()->tuteur; // Assure-toi que la relation existe
    $stagiaires = $tuteur->stagiaires; // Relation entre Tuteur et Stagiaire

    return view('tuteurs.mes_stagiaires', compact('stagiaires'));
}
}
