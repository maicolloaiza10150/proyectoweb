<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User; // Asegúrate de que este sea el path correcto a tu modelo User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Registra un nuevo usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // 1. Validar los datos de entrada
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' busca un campo 'password_confirmation'
        ]);

        // 2. Crear el nuevo usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Asegúrate de hashear la contraseña
        ]);

        // 3. Generar un token de API para el usuario
        // 'auth_token' es el nombre del token, puedes usar cualquier string descriptivo
        $token = $user->createToken('auth_token')->plainTextToken;

        // 4. Devolver la respuesta JSON
        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user' => $user, // Puedes optar por no devolver el objeto User completo por seguridad
            'token' => $token,
        ], 201); // Código de estado 201 para "Created"
    }

    /**
     * Inicia sesión a un usuario existente y genera un token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // 1. Validar los datos de entrada
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Buscar al usuario por email
        $user = User::where('email', $request->email)->first();

        // 3. Verificar credenciales (usuario existe y contraseña es correcta)
        if (!$user || !Hash::check($request->password, $user->password)) {
            // Si las credenciales son incorrectas, lanzar una excepción de validación
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        // 4. Eliminar tokens antiguos para este dispositivo si deseas una sesión única por token
        // Esto es opcional, si quieres que un usuario solo tenga un token activo por "login"
        $user->tokens()->where('name', 'auth_token')->delete(); // Elimina tokens con el nombre 'auth_token'

        // 5. Generar un nuevo token de API para el usuario
        $token = $user->createToken('auth_token')->plainTextToken;

        // 6. Devolver la respuesta JSON
        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'user' => $user, // Puedes optar por no devolver el objeto User completo por seguridad
            'token' => $token,
        ]);
    }

    /**
     * Cierra la sesión del usuario autenticado (revoca el token actual).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // 1. Revocar el token que se está usando actualmente para la solicitud
        $request->user()->currentAccessToken()->delete();

        // 2. Devolver la respuesta JSON
        return response()->json([
            'message' => 'Sesión cerrada exitosamente. Token revocado.',
        ]);
    }
}