<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Méthode pour l'inscription
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ],
        [
            'name.required' => 'Votre nom est requis',
            'email.required' => 'Votre email est requis',
            'password.required' => 'Votre mot de passe est requis',
            'password.confirmed' => 'Les mot de passe ne sont pas identique',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Inscription réussie',
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    // Méthode pour la connexion
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid login details'], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);
    }

    // Méthode pour la déconnexion
    public function logout(Request $request)
    {
        // Récupère et révoque le token de l'utilisateur
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Déconnexion réussie'], 200);
    }
}
