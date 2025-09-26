<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tuteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class TuteurController extends Controller
{
    // Afficher la liste des tuteurs
    public function index()
    {
        Log::info('Fetching tuteurs list');

        $tuteurs = Tuteur::with('user')->paginate(10);
        return view('tuteurs.index', compact('tuteurs'));
    }

    // Afficher le formulaire de création d'un tuteur
    public function create()
    {
        return view('tuteurs.create');
    }

    // Enregistrer un nouveau tuteur
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'phone' => 'nullable|string',
                'address' => 'nullable|string',
            ]);

            // Création de l'utilisateur
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Attribution du rôle "agent"
            $user->assignRole('agent');

            // Création du tuteur lié à cet utilisateur
            $tuteur = Tuteur::create([
                'user_id' => $user->id,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            Log::info('Tuteur created successfully', ['user_id' => $user->id, 'tuteur_id' => $tuteur->id]);

            return redirect()->route('tuteurs.index')->with('success', 'Tuteur ajouté avec succès.');
            
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création du tuteur : ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue : ' . $e->getMessage()])->withInput();
        }
    }

    // Afficher un tuteur
    public function show($id)
    {
        $tuteur = Tuteur::with('user')->findOrFail($id);
        return view('tuteurs.show', compact('tuteur'));
    }

    // Afficher le formulaire d'édition
    public function edit($id)
    {
        $tuteur = Tuteur::with('user')->findOrFail($id);
        return view('tuteurs.edit', compact('tuteur'));
    }

    // Mettre à jour un tuteur
    public function update(Request $request, Tuteur $tuteur)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $tuteur->user_id,
            'password' => 'nullable|min:6',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        // Mise à jour des informations de l'utilisateur
        $tuteur->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $tuteur->user->password,
        ]);

        // Mise à jour des informations du tuteur
        $tuteur->update([
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        Log::info('Tuteur updated successfully', ['tuteur_id' => $tuteur->id]);

        return redirect()->route('tuteurs.index')->with('success', 'Tuteur mis à jour avec succès.');
    }

    // Supprimer un tuteur
    public function destroy($id)
    {
        $tuteur = Tuteur::findOrFail($id);
        $user = $tuteur->user; 

        $tuteur->delete();
        $user->delete(); // Supprime également l'utilisateur

        Log::info('Tuteur deleted successfully', ['tuteur_id' => $id, 'user_id' => $user->id]);

        return redirect()->route('tuteurs.index')->with('success', 'Tuteur supprimé avec succès.');
    }
}
