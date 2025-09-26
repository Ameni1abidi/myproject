<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Stagiaire;
use App\Models\Tuteur;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Récupérer les données nécessaires pour le dashboard
        $totalUsers = User::count();
        $totalStagiaires = Stagiaire::count();
        $totalTuteurs = User::role('agent')->count();

        // Récupérer les stagiaires récents
        $recentStagiaires = Stagiaire::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Récupérer les tuteurs récents
        $recentTuteurs = User::role('agent')
            ->latest()
            ->take(5)
            ->get();

        // Récupérer les données des stagiaires par mois
        $stagiaires = Stagiaire::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->get();

        // Initialiser le tableau pour les données par mois
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $stagiairesData = array_fill(0, 12, 0);  // Tableau pour stocker les données des stagiaires

        foreach ($stagiaires as $stagiaire) {
            $stagiairesData[$stagiaire->month - 1] = $stagiaire->count;  // Remplir les données
        }

        // Retourner la vue avec toutes les données
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalStagiaires',
            'totalTuteurs',
            'recentStagiaires',
            'recentTuteurs',
            'stagiairesData',  // Ajouter les données des stagiaires par mois
            'months'  // Ajouter les mois pour le graphique
        ));
    }
}
