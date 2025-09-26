<?php

namespace App\Http\Controllers;

use App\Exports\StagiairesExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    // Export des stagiaires en Excel
    public function exportExcel()
    {
        return Excel::download(new StagiairesExport, 'stagiaires.xlsx');
    }

    // Export des stagiaires en PDF
    public function exportPDF()
    {
        $stagiaires = Stagiaire::all(); // Récupérer tous les stagiaires

        // Chargement de la vue PDF avec les données
        $pdf = Pdf::loadView('pdf.stagiaires', compact('stagiaires'));

        // Retourner le PDF en téléchargement
        return $pdf->download('stagiaires.pdf');
    }
}
