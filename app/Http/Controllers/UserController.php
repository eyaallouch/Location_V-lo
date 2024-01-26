<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }
    public function findIdUserByEmail($email)
    {
        // Recherche de l'utilisateur par adresse e-mail
        $user = User::where('email', $email)->first();

        // Vérifier si l'utilisateur a été trouvé
        if ($user) {
            // Récupérer l'ID de l'utilisateur
            $userId = $user->id_user;

            // Vous pouvez également retourner l'objet utilisateur complet si nécessaire
            // return $user;

            return $userId;
        } else {
            // Si l'utilisateur n'est pas trouvé, vous pouvez retourner null ou gérer d'une autre manière
            return null;
        }
    }
}
