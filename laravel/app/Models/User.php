<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // ¡Importante! Añadir este use statement

class User extends Authenticatable
{
<<<<<<< Updated upstream
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
=======
    use HasFactory, Notifiable, HasApiTokens; // ¡Importante! Añadir HasApiTokens aquí
>>>>>>> Stashed changes

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
<<<<<<< Updated upstream
=======
        'role', // Ya lo tenías, ¡bien!
>>>>>>> Stashed changes
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
<<<<<<< Updated upstream
}
=======

    /**
     * Check if the user has the 'admin' role.
     *
     * @return bool
     */
    public function isAdmin(): bool // Añadimos el tipo de retorno explícitamente
    {
        return $this->role === 'admin';
    }
}
>>>>>>> Stashed changes
