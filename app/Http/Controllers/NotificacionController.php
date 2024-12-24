<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        // Traer las notificaciones
        $notificaciones = auth()->user()->unreadNotifications;
        // limpiar notificaciones
        auth()->user()->unreadNotifications->markAsRead();
        // Mostrar vista
        return view('notificaciones.index',[
            'notificaciones' => $notificaciones
        ]);
    }
}
