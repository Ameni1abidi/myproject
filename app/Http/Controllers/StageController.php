<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\User;
use App\Models\Entreprise;
use Illuminate\Http\Request;

class StageController extends Controller
{
    public function index()
    {
        // Chargement des évaluations avec les autres relations
        $stages = Stage::with(['stagiaire', 'tuteur', 'entreprise', 'evaluations'])->get();
        return view('stages.index', compact('stages'));
    }

    public function create()
    {
        $stagiaires = User::whereHas('roles', function ($query) {
            $query->where('name', 'stagiaire');
        })->get();

        $tuteurs = User::whereHas('roles', function ($query) {
            $query->where('name', 'agent'); // 'agent' remplace 'tuteur'
        })->get();

        $entreprises = Entreprise::all();

        return view('stages.create', compact('stagiaires', 'tuteurs', 'entreprises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'stagiaire_id' => 'required|exists:users,id',  // Assurez-vous que le nom des colonnes est correct
            'tuteur_id' => 'nullable|exists:users,id',
            'entreprise_id' => 'nullable|exists:entreprises,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'statut' => 'required|in:disponible,en cours,terminé',
        ]);

        Stage::create($request->all());

        return redirect()->route('stages.index')->with('success', 'Stage ajouté avec succès');
    }

    public function edit(Stage $stage)
    {
        $stagiaires = User::whereHas('roles', function ($query) {
            $query->where('name', 'stagiaire');
        })->get();

        $tuteurs = User::whereHas('roles', function ($query) {
            $query->where('name', 'agent');
        })->get();

        $entreprises = Entreprise::all();

        return view('stages.edit', compact('stage', 'stagiaires', 'tuteurs', 'entreprises'));
    }

    public function update(Request $request, Stage $stage)
    {
        $request->validate([
            'stagiaire_id' => 'required|exists:users,id', // Assurez-vous que le nom des colonnes est correct
            'tuteur_id' => 'nullable|exists:users,id',
            'entreprise_id' => 'nullable|exists:entreprises,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'statut' => 'required|in:disponible,en cours,terminé',
        ]);

        $stage->update($request->all());

        return redirect()->route('stages.index')->with('success', 'Stage mis à jour avec succès');
    }

    public function destroy(Stage $stage)
    {
        $stage->delete();
        return redirect()->route('stages.index')->with('success', 'Stage supprimé avec succès');
    }

    public function show($id)
    {
        // Récupérer les informations du stage en fonction de l'ID
        $stage = Stage::findOrFail($id);

        // Retourner la vue avec les données du stage
        return view('stages.show', compact('stage'));
    }
}
