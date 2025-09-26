<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'stagiaire_id',
        'type',
        'file_path',
    ];

    public function stagiaire()
    {
        return $this->belongsTo(Stagiaire::class);
    }
}


