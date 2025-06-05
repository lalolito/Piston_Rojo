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
        // Verifica que el token no sea null o vacío
        if (!$idToken) {
            return response()->json(['success' => false, 'error' => 'Token vacío']);
        }

        // Verifica el token con Google
        $client = new \Google_Client(['client_id' => '857832425258-ic5rgbij8f69jp959am6qo1q5qmtijkb.apps.googleusercontent.com']);
        $payload = $client->verifyIdToken($idToken);

        if (!$payload) {
            \Log::error('Google token inválido', ['token' => $idToken]);
            return response()->json(['success' => false]);
        }

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
    }
}