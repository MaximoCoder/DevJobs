<?php

namespace App\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    public $cv;
    public $vacante;
    // Reglas de validacion
    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];
    // Importamos WithFileUploads
    use WithFileUploads;
    public function mount(Vacante $vacante){
        $this->vacante = $vacante;
    }
    // Funcion para postular
    public function postularme(){
       // Validar
       $datos = $this->validate();
        // Guardar el cv
        $cv = $this->cv->store('public/cv');
        // Reescribir en datos el nombre de la imagen
        $datos['cv'] = str_replace('public/cv/','',$cv); 
       //Crear la postulacion
       $this->vacante->candidatos()->create([
           'user_id' => auth()->user()->id,
           'cv' => $datos['cv'],
       ]);
       // Crear notificacion y enviar al email
       $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id));
       // Mostrar mensaje de ok
       session()->flash('mensaje', 'Postulacion realizada correctamente');
       return redirect()->back();
    }
    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
