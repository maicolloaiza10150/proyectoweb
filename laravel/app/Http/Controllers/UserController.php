<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Buscar el usuario por ID
        $user = User::findOrFail($id); 
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);  // Buscar el usuario por ID

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,  // Excluir el email actual
            'password' => 'nullable|string|min:8|confirmed',  // Contraseña opcional
        ]);
    
        // Si se proporciona una nueva contraseña, la actualizamos
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);  // Encriptar la nueva contraseña
        }
    
        // Actualizamos el usuario con los nuevos datos
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
    
        // Si el usuario autenticado es el mismo que el que se acaba de actualizar
        if (Auth::id() == $user->id) {
            // Cerrar la sesión del usuario para que inicie sesión nuevamente con la nueva contraseña
            Auth::logout();
            return redirect()->route('login')->with('success', 'Usuario actualizado correctamente. Por favor, inicia sesión con la nueva contraseña.');
        }
    
        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    $user = User::findOrFail($id);

    $user->delete();


    return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
