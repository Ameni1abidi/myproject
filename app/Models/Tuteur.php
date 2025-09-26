<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuteur extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'phone', 'address']; // Add other fields as needed

    // Relationship: A tuteur belongs to a user
    public function user()
{
    return $this->belongsTo(User::class);
}
// Relation : Un tuteur peut avoir plusieurs stagiaires
public function stagiaires()
{
    return $this->hasMany(Stagiaire::class, 'tutor_id'); // Le tuteur peut avoir plusieurs stagiaires
}

}
