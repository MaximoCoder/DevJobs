<?php

namespace App\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;

class FiltrarVacantes extends Component
{
    // Atributos de busqueda
    public $termino;
    public $categoria;
    public $salario;
    // Funcion para leer los filtros
    public function buscar(){
        $this->dispatch('terminosBusqueda', $this->termino, $this->categoria, $this->salario);
    }
    public function render()
    {
        // Obtener los salarios  y las categorias
        $salarios = Salario::all();
        $categorias = Categoria::all();
        return view('livewire.filtrar-vacantes',[
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}
