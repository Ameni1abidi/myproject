<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    use HasFactory;

    protected $fillable = [
        'stage_id',
        'contenu',
        'date',
    ];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
