<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;


use App\Models\Campania;
use App\Models\SolicitudDonacion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $fillable = [
        'name',
        'email',
        'password',
        'nombres', // Nombre(s) del usuario
        'apellidos', // Apellidos del usuario
        'dni', // Documento Nacional de Identidad (DNI) del usuario
        'fecha_nacimiento', // Fecha de nacimiento del usuario
        'sexo', // Sexo del usuario
        'tipo_sangre', // Tipo de sangre del usuario
        'telefono', // Teléfono del usuario
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function solicitudes()
    {
        return $this->hasMany(SolicitudDonacion::class);
    }

    public function isAdmin()
    {

        return $this->roles()->where('name', 'admin')->exists();
    }

    public function hasActiveSolicitudInCampania(Campania $campania)
    {
        return $this->solicitudes()->where('campania_id', $campania->id)->exists();
    }

    public function hasRecentSolicitud()
    {
        $twoMonthsAgo = Carbon::now()->subMonths(2);
        return $this->solicitudes()->where('created_at', '>=', $twoMonthsAgo)->exists();
    }
}