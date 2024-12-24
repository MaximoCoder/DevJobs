<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Llamamos al policy
        $this->authorize('viewAny', Vacante::class);
        // Mostramos la vista de las vacantes
        return view('vacantes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Llamamos al policy
        $this->authorize('create', Vacante::class);
        //  Mostramos la vista para crear una nueva vacante
        return view('vacantes.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacante $vacante)
    {
        // Mostrar vista
        return view('vacantes.show',[
            'vacante' => $vacante 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacante $vacante)
    {
        // LLamamos al policy
        $this->authorize('update', $vacante);
        // Funcion para editar una vacante
        return view('vacantes.edit',[
            'vacante' => $vacante
        ]);
    }

}
