<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    use HasFactory;
    // Permitir los campos llenables
    protected $fillable = [
        'user_id',
        'vacante_id',
        'cv',
    ];
    // Relacion con usuario
    public function user(){
        return $this->belongsTo(User::class);
    }
}
