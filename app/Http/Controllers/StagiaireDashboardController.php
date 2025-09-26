<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stagiaire;
use App\Models\User;
use App\Models\Stage;
use Illuminate\Support\Facades\Auth;

class StagiaireDashboardController extends Controller
{
    // Afficher les informations du stagiaire et ses évaluations
    // StagiaireDashboardController.php
    public function index()
{
    $user = auth()->user(); // Get the logged-in user

    // Get the stagiaire associated with the logged-in user
    $stagiaire = $user->stagiaires()->first(); // Use first() to get a specific stagiaire

    if (!$stagiaire) {
        return redirect()->route('dashboard')->with('error', 'Aucune information trouvée pour ce stagiaire.');
    }

    // Get the stage associated with the stagiaire (this will now return a single instance)
    $stage = $stagiaire->stage; // This is a single Stage model instance

    if (!$stage) {
        $evaluations = collect(); // If no stage, return an empty collection for evaluations
    } else {
        // Get the evaluations associated with the stage
        $evaluations = $stage->evaluations; // This will work now because stage is a single instance
    }

    // Get the tuteur associated with the stagiaire
    $tuteur = $stagiaire->tuteur;

    return view('dashboard_stagiaire', compact('stagiaire', 'tuteur', 'evaluations', 'stage'));
}




    // Afficher les évaluations du stagiaire
    public function showEvaluations()
    {
        // Récupérer le stagiaire connecté
        $stagiaire = Auth::user()->stagiaires()->first(); // On utilise `first()` pour récupérer un stagiaire spécifique

        if (!$stagiaire) {
            return redirect()->route('dashboard')->with('error', 'Aucun stagiaire trouvé.');
        }

        // Récupérer le stage du stagiaire
        $stage = $stagiaire->stage; // Utilisation de la relation

        if (!$stage) {
            return redirect()->route('dashboard')->with('error', 'Aucun stage trouvé pour ce stagiaire.');
        }

        // Récupérer les évaluations associées au stage
        $evaluations = $stage->evaluations()->with('tuteur')->get(); // Utilisation de la relation avec les évaluations

        return view('stagiaires.evaluations', compact('evaluations'));
    }

    // Afficher les stages du stagiaire
    

}
