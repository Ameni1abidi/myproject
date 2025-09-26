<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        Log::info('Fetching admin list');

        $admins = Admin::with('user')->paginate(10);
        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone_number' => 'nullable|string|max:20',
        ]);

        try {
            // Création de l'utilisateur avec le rôle "admin"
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole('admin');

            // Création de l'administrateur
            Admin::create([
                'user_id' => $user->id,
                'phone_number' => $request->phone_number,
            ]);

            Log::info('Admin created successfully', ['user_id' => $user->id]);
            return redirect()->route('admin.index')->with('success', 'Administrateur ajouté avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de l\'admin : ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue : ' . $e->getMessage()])->withInput();
        }
    }

    public function show($id)
    {
        $admin = Admin::with('user')->findOrFail($id);
        return view('admin.show', compact('admin'));
    }

    public function edit($id)
    {
        $admin = Admin::with('user')->findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $user = $admin->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'phone_number' => 'nullable|string|max:20',
        ]);

        // Mise à jour de l'utilisateur
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        // Mise à jour des informations de l'administrateur
        $admin->update([
            'phone_number' => $request->phone_number,
        ]);

        Log::info('Admin updated successfully', ['admin_id' => $admin->id]);

        return redirect()->route('admin.index')->with('success', 'Administrateur mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $user = $admin->user;

        // Suppression de l'utilisateur (cascade supprimera l'admin aussi)
        $user->delete();

        Log::info('Admin deleted successfully', ['admin_id' => $id]);

        return redirect()->route('admin.index')->with('success', 'Administrateur supprimé avec succès.');
    }
}
