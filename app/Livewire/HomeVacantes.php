<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class HomeVacantes extends Component
{
    // Atributos de busqueda
    public $termino;
    public $categoria;
    public $salario;
    // LISTENER
    protected $listeners = ['terminosBusqueda' => 'buscar']; // Escucha por 'terminosBusqueda' y ejecuta la funcion 'buscar'
    public function buscar($termino, $categoria, $salario){
        // Asignar los valores
        $this->termino = $termino;
        $this->categoria = $categoria;
        $this->salario = $salario;
    }
    public function render()
    {
        // Obtener las vacantes
        //$vacantes = Vacante::all();
        // Obtener las vacantes filtradas
        $vacantes = Vacante::when($this->termino, function($query){
            $query->where('titulo', 'LIKE', '%' . $this->termino . '%'); // Buscar en el titulo
        })
        ->when($this->termino, function($query){
            $query->orWhere('empresa', 'LIKE', '%' . $this->termino . '%'); // Buscar en la empresa
        })
        ->when($this->categoria, function($query){
            $query->where('categoria_id', $this->categoria); // Buscar en la categoria
        })
        ->when($this->salario, function($query){
            $query->where('salario_id', $this->salario); // Buscar en el salario
        })->paginate(15); // Paginar o usar get.
        return view('livewire.home-vacantes',[
            'vacantes' => $vacantes
        ]);
    }
}
