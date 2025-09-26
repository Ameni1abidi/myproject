<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        // Récupérer les utilisateurs avec leurs permissions
        $users = User::with('permissions')->get();
        return view('admin.permissions.index', compact('users'));
    }

    public function edit(User $user)
    {
        // Récupérer toutes les permissions existantes
        $permissions = Permission::all();
        return view('admin.permissions.edit', compact('user', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        // Validation des permissions sélectionnées
        $request->validate([
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        // Synchroniser les permissions de l'utilisateur
        $user->syncPermissions($request->permissions ?? []);

        return redirect()->route('admin.permissions.index')->with('success', 'Permissions mises à jour avec succès.');
    }
}
