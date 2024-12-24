<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithFileUploads;

class EditarVacante extends Component
{
    // Atributos
    public $vacante_id;
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen; 
    public $imagen_nueva; // Atributo para almacenar la imagen nueva

    use WithFileUploads;
    // Reglas de validacion
    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required|string',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen_nueva' => 'nullable|image|max:1024', // 1mb
    ];

    // Usamos mount
    public function mount(Vacante $vacante){
        // Traer la informacion de la vacante
        $this->vacante_id = $vacante->id;
        $this->titulo = $vacante->titulo;
        $this->salario = $vacante->salario_id;
        $this->categoria = $vacante->categoria_id;
        $this->empresa = $vacante->empresa;
        $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format('Y-m-d'); // FORMATEAR LA FECHA A Y-m-d
        $this->descripcion = $vacante->descripcion;
        $this->imagen = $vacante->imagen;
    }
    // Editar vacante
    public function editarVacante(){
        // Validar
        $datos = $this->validate();
        // Si hay una nueva imagen
        if($this->imagen_nueva){
            $imagen = $this->imagen_nueva->store('public/vacantes');
            $datos['imagen'] = str_replace('public/vacantes', '', $imagen);
        }
        // Encontrar la vacante a editar
        $vacante = Vacante::find($this->vacante_id);
        // asignar los valores
        $vacante->titulo = $datos['titulo'];
        $vacante->salario_id = $datos['salario'];
        $vacante->categoria_id = $datos['categoria'];
        $vacante->empresa = $datos['empresa'];
        $vacante->ultimo_dia = $datos['ultimo_dia'];
        $vacante->descripcion = $datos['descripcion'];
        $vacante->imagen = $datos['imagen'] ?? $vacante->imagen; // Reemplazar la imagen vieja con la nueva si la hay
        // Guardar la vacante
        $vacante->save();
        // Redirigir al usuario
        session()->flash('mensaje', 'Vacante actualizada correctamente'); // Mostrar mensaje de exito
        return redirect()->route('vacantes.index');
    }
    public function render()
    {
        // Traer los datos de salarios y categorias
        $salarios = Salario::all();
        $categorias = Categoria::all();
        return view('livewire.editar-vacante',[
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}
