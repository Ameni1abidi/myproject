<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Stagiaire;
use App\Models\Tuteur;
use App\Models\Admin;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        // Fetch users with their roles
        $users = User::with('roles')->get();

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        // Fetch all available roles
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        // Validate roles input
        $request->validate([
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,name',
        ]);

        // Sync user roles
        $user->syncRoles($request->roles);

        // Update or delete corresponding records in the related tables
        if (in_array('stagiaire', $request->roles)) {
            // Assurez-vous que l'utilisateur est lié à un stagiaire
            Stagiaire::updateOrCreate(
                ['user_id' => $user->id],
            );
        } else {
            // Supprimez l'enregistrement dans la table stagiaires si l'utilisateur n'a plus le rôle stagiaire
            Stagiaire::where('user_id', $user->id)->delete();
        }

        if (in_array('agent', $request->roles)) {
            // Assurez-vous que l'utilisateur est lié à un tuteur
            Tuteur::updateOrCreate(
                ['user_id' => $user->id],
                
            );
        } else {
            // Supprimez l'enregistrement dans la table tuteurs si l'utilisateur n'a plus le rôle agent
            Tuteur::where('user_id', $user->id)->delete();
        }

        if (in_array('admin', $request->roles)) {
            // Assurez-vous que l'utilisateur est lié à un administrateur
            Admin::updateOrCreate(
                ['user_id' => $user->id],
                
            );
        } else {
            // Supprimez l'enregistrement dans la table admins si l'utilisateur n'a plus le rôle admin
            Admin::where('user_id', $user->id)->delete();
        }

        return redirect()->route('admin.users.index')->with('success', 'User roles updated successfully.');
    }
    public function create()
{
    $roles = Role::all(); // Récupérer tous les rôles

    return view('admin.users.create', compact('roles'));
}

public function store(Request $request)
{
    // Validation des données
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|min:6',
        'roles' => 'required|array|min:1',
        'roles.*' => 'exists:roles,name',
    ]);

    // Création de l'utilisateur
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // Assigner les rôles
    $user->assignRole($request->roles);

    // Vérifier si des tables spécifiques doivent être mises à jour
    if (in_array('stagiaire', $request->roles)) {
        Stagiaire::create(['user_id' => $user->id]);
    }

    if (in_array('agent', $request->roles)) {
        Tuteur::create(['user_id' => $user->id]);
    }

    if (in_array('admin', $request->roles)) {
        Admin::create(['user_id' => $user->id]);
    }

    return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès.');
}

}
