<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'contact'];

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
}

