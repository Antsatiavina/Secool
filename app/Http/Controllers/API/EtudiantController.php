<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use App\Models\Classe;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes=Classe::All();
        $etudiants=Etudiant::All();
        return response()->json($etudiants);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $etudiant = Etudiant::create([
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'classe_id'=>$request->classe
        ]);
        return response()->json($etudiant, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Etudiant $etudiant)
    {
        return response()->json($etudiant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $etudiant->update([
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'classe_id'=>$request->classe
        ]);
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();
        return response()->json();
    }
}
