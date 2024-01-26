<?php

namespace App\Http\Controllers;

use App\Models\Velo;
use Illuminate\Http\Request;
use App\Models\Modele; 
use Illuminate\Support\Facades\Validator;
class VeloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Velo::join('modeles','modeles.id_model','=','velos.id_model')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //enregister

              $rules = [
                  'nom_velo' => 'required|string|max:255',
                  'year' => 'required|integer',
                  'price_day' => 'required|numeric',
                 'disponibilité' => 'nullable|boolean',
                'image' => 'required|string|max:255',
                  'id_model' => 'required|exists:modeles,id_model',
              ];
         
        //      // Créer un validateur avec les règles définies
              $validator = Validator::make($request->all(), $rules);
         
        //      // Vérifier si la validation a échoué
             if ($validator->fails()) {
                 return response()->json(['errors' => $validator->errors()], 400);
             }
         
        //      // Si la validation réussit, enregistrer le vélo
              $velo = new Velo([
                  'nom_velo' => $request->input('nom_velo'),
                  'year' => $request->input('year'),
                  'price_day' => $request->input('price_day'),
                  'disponibilité' => $request->input('disponibilité'),
                  'image' => $request->input('image'),
                 'id_model' => $request->input('id_model'),
             ]);
         
              $velo->save();
         
              return response()->json($velo, 201);
          }
         
    
   /* public function store(Request $request)
    {
        // Récupérer le modèle associé
        $modele = Modele::find($request->input('id_model'));
    
        // Vérifier si le modèle existe
        if (!$modele) {
            return response()->json(['message' => 'Modèle non trouvé'], 404);
        }
    
        // Enregistrer le vélo avec la relation associée
        $velo = new Velo([
            'nom_velo' => $request->input('nom_velo'),
            'year' => $request->input('year'),
            'price_heure' => $request->input('price_heure'),
            'disponibilité' => $request->input('disponibilité'),
            'image' => $request->input('image'),
        ]);
    
        // Associer le modèle au vélo
        $velo->modele()->associate($modele);
    
        // Enregistrer le vélo
        $velo->save();
    
        return response()->json($velo, 201);
    }*/
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
           //getById
           $velo = Velo::join('modeles','modeles.id_model','=','velos.id_model')->find($id);
           return response()->json($velo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
                     //put methode
// Définir les règles de validation
     $rules = [     
         'nom_velo' => 'required|string|max:255',
          'year' => 'required|integer',
          'price_day' => 'required|numeric',
           'disponibilité' => 'required|boolean',
           'image' => 'required|string|max:255',
              'id_model' => 'required|exists:modeles,id_model',
            ];

        // Créer un validateur avec les règles définies
          $validator = Validator::make($request->all(), $rules);

             // Vérifier si la validation a échoué
      if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
            }

           // Trouver le vélo à mettre à jour
         $velo = Velo::find($id);

         // Vérifier si le vélo existe
          if (!$velo) {
               return response()->json(['error' => 'Vélo non trouvé'], 404);
           }

        // Mettre à jour les données du vélo
        $velo->update($request->all());

          return response()->json($velo, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_velo)
    {
        $velo = Velo:: where('id_velo', $id_velo)->first();
    
        if (!$velo) {
            return response()->json(['message' => 'Vélo non trouvé'], 404);
        }
    
        $velo->delete();
        return response()->json('velo deleted !');
    }
}
