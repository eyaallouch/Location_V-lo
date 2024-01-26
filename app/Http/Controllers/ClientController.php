<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Client::join('users','users.id_user','=','clients.id_user')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Définir les règles de validation
        $rules = [
            'cin' => 'required|string|size:8',
            'age' => 'required|integer|min:21',
            'number' => 'required|string|size:8',
            'id_user' => 'required|integer', // Vous pouvez ajuster cela en fonction de vos besoins
        ];
    
        // Définir les messages d'erreur personnalisés
        $messages = [
            'cin.size' => 'Le champ CIN doit avoir exactement 8 caractères.',
            'age.min' => 'L\'âge doit être supérieur à 20.',
            'number.size' => 'Le numéro de téléphone doit avoir exactement 8 caractères.',
        ];
    
        // Valider les données
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // Vérifier si la validation échoue
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $existingClient = Client::where('cin', $request->input('cin'))
        ->exists();
        if ($existingClient) {
            return response()->json(['vous etes déjà notre client!'], 400);
        }
        // Si la validation réussit, enregistrer le client
        $client = new Client([
            'cin' => $request->input('cin'),
            'age' => $request->input('age'),
            'number' => $request->input('number'),
            'id_user' => $request->input('id_user'),
        ]);
    
        $client->save();
        
        return response()->json($client, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
              //getById
        
              $client = Client::join('users','users.id_user','=','clients.id_user')->find($id);
              return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Valider les données du formulaire
    $validator = Validator::make($request->all(), [
        'cin' => 'required|digits:8|unique:clients,cin,' . $id,
        'age' => 'required|numeric|min:21',
        'number' => 'required|digits:8|unique:clients,number,' . $id,
        'id_user' => 'required|numeric',
    ]);

    // Si la validation échoue, renvoyer les erreurs
    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    // Mettre à jour le client dans la base de données
    $client = Client::find($id);
    $client->update($request->all());

    return response()->json($client, 200);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
                     //delete
                     $client = Client::find($id);
                     $client->delete();
                     return response()->json('client deleted !');
    }
    public function findIdClientBycin($cin)
    {
         // Recherche de l'utilisateur par adresse e-mail
         $client = Client::where('cin', $cin)->first();

         // Vérifier si l'utilisateur a été trouvé
         if ($client) {
             // Récupérer l'ID de l'utilisateur
             $clientId = $client->id_client;
 
             // Vous pouvez également retourner l'objet utilisateur complet si nécessaire
             // return $user;
 
             return $clientId;
         } else {
             // Si l'utilisateur n'est pas trouvé, vous pouvez retourner null ou gérer d'une autre manière
             return null;
         }
    }
}
