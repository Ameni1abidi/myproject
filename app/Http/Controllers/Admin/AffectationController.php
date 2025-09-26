<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stagiaire;
use App\Models\User;

class AffectationController extends Controller
{
    public function index()
    {
        // Récupérer tous les stagiaires sans tuteur
        $stagiaires = Stagiaire::whereNull('tutor_id')->get();

        

        // Récupérer les tuteurs ayant le rôle 'agent'
        $tutors = User::whereHas('roles', function ($query) {
            $query->where('name', 'agent');
        })->get();

        return view('admin.affectations.index', compact('stagiaires', 'tutors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'stagiaire_id' => 'required|exists:stagiaires,id',
            'tutor_id' => 'required|exists:users,id',
        ]);

        // Récupérer le stagiaire et l'affecter au tuteur
        $stagiaire = Stagiaire::findOrFail($request->stagiaire_id);
        $stagiaire->tutor_id = $request->tutor_id;
        $stagiaire->save();

        // Rediriger vers la page d'affectations avec un message de succès
        return redirect()->route('admin.affectations.index')->with('success', 'Stagiaire affecté avec succès.');
    }
}
