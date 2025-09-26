<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stagiaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'entreprise',
        'statut',
        'tutor_id',
        'cv', // For storing the CV path
        'institution', // For storing the institution name
    ];

    // Relationship with the User (intern)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

   

public function tuteur()
{
    return $this->belongsTo(User::class, 'tutor_id'); 
}
public function stagiaire()
{
    return $this->belongsTo(Stagiaire::class, 'user_id'); 
}
public function stage()
    {
        return $this->hasOne(Stage::class, 'stagiaire_id'); 
    }
    public function evaluations()
    {
        return $this->hasManyThrough(Evaluation::class, Stage::class, 'stagiaire_id', 'stage_id');
    }
}
