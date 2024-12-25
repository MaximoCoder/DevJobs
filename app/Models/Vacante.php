<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    use HasFactory;
    // Definir los tipo fecha
    protected $casts = [
        'ultimo_dia' => 'datetime'
    ];
    // Definir que datos de la tabla se pueden manipular
    protected $fillable = ['titulo', 'salario_id', 'categoria_id', 'empresa', 'ultimo_dia', 'descripcion', 'imagen', 'user_id'];

    // Incluimos las relaciones 
    public function salario(){
        return $this->belongsTo(Salario::class);
    }
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
    public function candidatos(){
        return $this->hasMany(Candidato::class)->orderBy('created_at', 'desc');
    }
    public function reclutador(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
