<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CrearVacante extends Component
{
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    // Permitir imagenes
    use WithFileUploads;

    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required|string',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|max:1024', // 1mb
    ];
    // Funcion para procesar el formulario
    public function crearVacante(){
        $datos = $this->validate();

        // Guardar la imagen
        $imagen = $this->imagen->store('public/vacantes');
        // Reescribir en datos el nombre de la imagen
        $datos['imagen'] = str_replace('public/vacantes/','',$imagen); // Quitar la carpeta public/vacantes/ de la ruta de la imagen
        // Crear la vacante
        Vacante::create([
            'titulo' => $datos['titulo'],
            'salario_id' => $datos['salario'],
            'categoria_id' => $datos['categoria'],
            'empresa'=> $datos['empresa'],
            'ultimo_dia' => $datos['ultimo_dia'],
            'descripcion'=> $datos['descripcion'],
            'imagen' => $datos['imagen'],
            'user_id' => auth()->user()->id
        ]);
        // Mostrar mensaje de exito
        session()->flash('mensaje', 'Vacante creada correctamente');
        // Redireccionar al usuario
        return redirect()->route('vacantes.index');
    }
    public function render()
    {
        // Traer la informacion de la tabla salarios llamando al modelo
        $salarios = Salario::all();
        // Traer las categorias
        $categorias = Categoria::all();
        return view('livewire.crear-vacante',[
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}
