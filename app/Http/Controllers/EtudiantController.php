<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Classe;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index(){
      $classes=Classe::All();
        $etudiants=Etudiant::with('classe')->orderBy("nom","asc")->get();
        return view("etudiant.show",compact("etudiants","classes"));
    }
     public function insert(Request $request){
        $etudiant = new Etudiant;
        $etudiant->nom=$request->input('nom');
        $etudiant->prenom=$request->input('prenom');
        $etudiant->classe_id=$request->input('classe');
        $etudiant->save();
        //Validation form 
        // $request->validate([
        //     'nom'=>'required',
        //     'prenom'=>'required',
        //     'classe'=>'required'
        // ]);
        return redirect('etudiant_list')->with("insert_success", "Ajout nouvelle ligne réussie");
     }
      public function modify(Request $request,$id){
        $etudiant=Etudiant::where('id',$id)->first();
        $etudiant->nom=$request->input('nom');
        $etudiant->prenom=$request->input('prenom');
        $etudiant->classe_id=$request->input('classe');
        $etudiant->save();
        return redirect('etudiant_list')->with("modify_success", "Modification réussie");
      }
      public function delete($id){
        $etudiant=Etudiant::where('id',$id)->first();
        $etudiant->delete();
        return redirect('etudiant_list')->with("delete_success", "Suppression réussie");
      }
}
