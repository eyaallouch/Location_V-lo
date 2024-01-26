<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Velo;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Location::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //enregister
         $location = new Location([
            'id_client' => $request->input('id_client'),
            'id_velo' => $request->input('id_velo'),
            'datedebut' => $request->input('datedebut'),
            'datefin' => $request->input('datefin'),

            ]);
            $location->save();
            return response()->json($location, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
                  //getById
                  $location = Location::find($id);
                  return response()->json($location);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
                     //put methode
                     $location = Location::find($id);
                     $location->update($request->all());
                     return response()->json($location, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
                              //delete
                              $location = Location::find($id);
                              $location->delete();
                              return response()->json('location deleted !');
    }
    

 
    
    public function verifierDisponibiliteVelo(Request $request)
    {
          $idVelo = $request->input('idVelo');
           $dateDebut = $request->input('dateDebut');
            $dateFin = $request->input('dateFin');
        try {
            // Vérifier si le vélo existe
          $velo = Velo::findOrFail($idVelo);
    
            // Vérifier la disponibilité du vélo
            if ($velo->disponibilité === 0) {
               // return 0;
                throw new \Exception("Le vélo est hors service.");
           }
           $resultat = Location::where('id_velo', $idVelo)
           ->where(function ($query) use ($dateDebut, $dateFin) {
               $query->whereBetween('datedebut', [$dateDebut, $dateFin])
                   ->orWhereBetween('datefin', [$dateDebut, $dateFin])
                   ->orWhere(function ($query) use ($dateDebut, $dateFin) {
                       $query->where('datedebut', '<=', $dateDebut)
                           ->where('datefin', '>=', $dateFin);
                   });
           })
           ->count();
       
            // // Requête SQL pour vérifier les dates de location
            // $resultat = DB::table('locations')
            //     ->where('id_velo', $idVelo)
            //     ->where(function ($query) use ($dateDebut, $dateFin) {
            //         $query->whereBetween('datedebut', [$dateDebut, $dateFin])
            //             ->orWhereBetween('datefin', [$dateDebut, $dateFin])
            //             ->orWhere(function ($query) use ($dateDebut, $dateFin) {
            //                 $query->where('datedebut', '<=', $dateDebut)
            //                     ->where('datefin', '>=', $dateFin);
            //             });
            //     })
            //     ->count();
    
            // Si le résultat est supérieur à zéro, cela signifie que le vélo n'est pas disponible
            if ($resultat > 0) {
              //  return 0;
                throw new \Exception("Le velo n'est disponible pour ces dates.");
            }
    
            // Si tout est OK, le vélo est disponible
            return true;
    
        } catch (ModelNotFoundException $e) {
          //  La voiture n'a pas été trouvée
           throw new \Exception("Vélo non trouvé.", 404);
        }
    }
    

}
