<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'stage_id', 'titre', 'description', 'is_completed',
    ];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}

