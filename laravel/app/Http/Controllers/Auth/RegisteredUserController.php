<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Crear el usuario en la base de datos
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Emitir el evento de registrado
        event(new Registered($user));

        // Logear al usuario
        Auth::login($user);

        // Obtener el archivo users.json (crear si no existe)
        $filePath = database_path('data/users.json');

        if (File::exists($filePath)) {
            // Leer los datos existentes
            $json = File::get($filePath);
            $users = json_decode($json, true);
        } else {
            // Si el archivo no existe, inicializar un arreglo vacío
            $users = [];
        }

        // Encriptar la contraseña antes de guardarla en el JSON
        $encryptedPassword = Hash::make($request->password);

        // Añadir el nuevo usuario al archivo JSON
        $users[] = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $encryptedPassword, // Almacenar la contraseña encriptada
        ];

        // Guardar los datos nuevamente en el archivo
        File::put($filePath, json_encode($users, JSON_PRETTY_PRINT));

        // Redirigir al usuario después de la creación
        return redirect(route('register', absolute: false));
    }
}
