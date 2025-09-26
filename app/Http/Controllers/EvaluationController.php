<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stage;  // Assure-toi d'importer le modèle Stage
use App\Models\Evaluation;

class EvaluationController extends Controller
{
    public function store(Request $request, Stage $stage)
    {
        // Logique pour enregistrer une évaluation
        // Exemple d'enregistrement d'une évaluation pour un stage donné
        $validated = $request->validate([
            'note' => 'required|numeric|min:0|max:20',
            'commentaire' => 'nullable|string',
        ]);

        $evaluation = new Evaluation();
        $evaluation->stage_id = $stage->id;
        $evaluation->note = $validated['note'];
        $evaluation->commentaire = $validated['commentaire'];
        $evaluation->save();

        return redirect()->route('stages.show', $stage)->with('success', 'Évaluation ajoutée avec succès.');
    }
    public function editEvaluation($stageId)
{
    // Trouver le stage par son ID
    $stage = Stage::findOrFail($stageId);

    // Trouver la première évaluation pour ce stage
    $evaluation = $stage->evaluations()->first();

    // Si aucune évaluation n'existe pour ce stage, rediriger avec un message d'erreur
    if (!$evaluation) {
        return redirect()->route('stages.index')->with('error', 'Aucune évaluation trouvée pour ce stage.');
    }

    // Passer les données à la vue pour affichage
    return view('evaluations.edit', compact('stage', 'evaluation'));
}

public function updateEvaluation(Request $request, $stageId)
{
    $request->validate([
        'note' => 'required|integer|min:0|max:20',
        'commentaire' => 'nullable|string',
    ]);

    $stage = Stage::findOrFail($stageId);
    $evaluation = $stage->evaluations()->first(); // On suppose qu'un stagiaire ne peut avoir qu'une évaluation par tuteur
    
    // Met à jour l'évaluation
    $evaluation->update([
        'note' => $request->note,
        'commentaire' => $request->commentaire,
    ]);

    return redirect()->route('stages.index')->with('success', 'Évaluation mise à jour avec succès');
}
}
