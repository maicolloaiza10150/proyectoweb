<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        $this->syncUsersToJson();

        if (Auth::id() == $user->id) {
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

        $this->syncUsersToJson();

        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado correctamente.');
    }

    /**
     * Sincroniza los usuarios con el archivo JSON.
     */
    private function syncUsersToJson()
    {
        $users = User::all()->map(function ($user) {
            return [
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password, // ya encriptada
            ];
        })->toArray();

        $filePath = database_path('data/users.json');
        File::put($filePath, json_encode($users, JSON_PRETTY_PRINT));
    }
}
