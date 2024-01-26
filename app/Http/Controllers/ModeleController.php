<?php

namespace App\Http\Controllers;

use App\Models\Modele;
use Illuminate\Http\Request;

class ModeleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Modele::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //enregister
         $modele= new Modele([
            'nom_model' => $request->input('nom_model'),
            ]);
            $modele->save();
            return response()->json($modele, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
                 //getById
                 $modele = Modele::find($id);
                 return response()->json($modele);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
          //put methode
          $modele = Modele::find($id);
          $modele->update($request->all());
          return response()->json($modele, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //delete
        $modele = Modele::find($id);
        $modele->delete();
        return response()->json('modele deleted !');
    }
}
