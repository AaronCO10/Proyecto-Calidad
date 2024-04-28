<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudDonacion extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'campania_id', 'talla', 'peso', 'acepta_terminos', 'estado'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campania()
    {
        return $this->belongsTo(Campania::class);
    }
}
