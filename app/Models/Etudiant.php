<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classe;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom'
    ];

    public function classe(){
        return $this->hasOne(Classe::class,'id','classe_id')->select('id','libelle');
    }
}
?>