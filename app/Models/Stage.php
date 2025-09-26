<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = ['stagiaire_id', 'entreprise_id', 'tutor_id', 'date_debut', 'date_fin', 'statut'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function stagiaire()
    {
        return $this->belongsTo(User::class, 'stagiaire_id');
    }
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function tuteur()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    public function rapports()
    {
        return $this->hasMany(Rapport::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class); // Assuming a stage can have many evaluations
    }

    
}
