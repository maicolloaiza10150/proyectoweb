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
use App\Models\Card;

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
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $card = Card::create([
        'descripcion' => 'Tarjeta de ' . $user->name,
        'saldo' => rand(100, 1000),
        'user_id' => $user->id,
    ]);

    $cardFilePath = database_path('data/cards.json');

    if (File::exists($cardFilePath)) {
        $cards = json_decode(File::get($cardFilePath), true);
    } else {
        $cards = [];
    }

    $cards[] = [
        'descripcion' => $card->descripcion,
        'saldo' => $card->saldo,
        'user_id' => $card->user_id,
    ];

    File::put($cardFilePath, json_encode($cards, JSON_PRETTY_PRINT));

    event(new Registered($user));

    Auth::login($user);

    $userFilePath = database_path('data/users.json');
    if (File::exists($userFilePath)) {
        $users = json_decode(File::get($userFilePath), true);
    } else {
        $users = [];
    }

    $encryptedPassword = Hash::make($request->password);

    $users[] = [
        'name' => $user->name,
        'email' => $user->email,
        'password' => $encryptedPassword,
    ];

    File::put($userFilePath, json_encode($users, JSON_PRETTY_PRINT));

    return redirect(route('register', absolute: false));
}
    
}
