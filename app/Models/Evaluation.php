<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = ['stage_id', 'tuteur_id', 'note', 'commentaire'];

    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }

    public function tuteur()
    {
        return $this->belongsTo(User::class, 'tuteur_id');
    }

    public function stagiaire()
    {
        return $this->belongsTo(Stagiaire::class);
    }
}


