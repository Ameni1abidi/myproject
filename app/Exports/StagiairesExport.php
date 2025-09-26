<?php

namespace App\Exports;

use App\Models\Stagiaire;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StagiairesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Stagiaire::with('user')->get()->map(function ($stagiaire) {
            return [
                'id' => $stagiaire->id,
                'nom' => $stagiaire->user ? $stagiaire->user->name : '',
                'email' => $stagiaire->user ? $stagiaire->user->email : '',
                'entreprise' => $stagiaire->entreprise,
                'statut' => $stagiaire->statut,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nom',
            'Email',
            'Entreprise',
            'Statut',
        ];
    }
}
