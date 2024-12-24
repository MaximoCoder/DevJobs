<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class MostrarVacantes extends Component
{
    // LISTENERS para manejar emit
    protected $listeners = ['eliminarVacante'];
    // Funcion para eliminar una vacante
    public function eliminarVacante(Vacante $vacanteId){
        // Eliminar la vacante
        $vacanteId->delete();
    }
    public function render()
    {
        // Traer las vacantes del usuario autenticado
        $vacantes = Vacante::where('user_id', auth()->user()->id)->paginate(10);
        return view('livewire.mostrar-vacantes',[
            'vacantes' => $vacantes
        ]);
    }
}
