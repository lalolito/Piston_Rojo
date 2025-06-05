<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleLoginController extends Controller
{
    public function login(Request $request)
    {
        $idToken = $request->token;

        // Verifica el token con Google
        $client = new \Google_Client(['client_id' => '709609617298-7v5v7v7v.apps.googleusercontent.com']);
        $client->setLeeway(60); // 60 segundos de margen para desfase horario
        $payload = $client->verifyIdToken($idToken);

        if ($payload) {
            $email = $payload['email'];
            $name = $payload['name'] ?? 'Usuario Google';

            // Busca o crea el usuario
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => Hash::make(uniqid()), // Contraseña aleatoria
                ]
            );

            Auth::login($user);

            // Redirige según el email
            if ($email === "hm971535@gmail.com") {
                return response()->json(['success' => true, 'redirect' => url('/admin')]);
            } else {
                return response()->json(['success' => true, 'redirect' => url('/cliente/inicio')]);
            }
        } else {
            return response()->json(['success' => false]);
        }
    }
}