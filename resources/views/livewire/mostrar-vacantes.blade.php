<div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <!-- Validar si tiene vacantes -->
        @if ( $vacantes->count() )
            @foreach ( $vacantes as $vacante )
                <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
                    <div class="leading-10">
                        <a href="{{ route('vacantes.show', $vacante->id) }}" class="text-xl font-bold">
                            {{ $vacante->titulo }}
                        </a>
                        <p class="text-sm text-gray-600 font-bold">{{ $vacante->empresa }}</p>
                        <p class="text-sm text-gray-500">Ultimo dia para aplicar: {{ $vacante->ultimo_dia->format('d/m/Y') }}</p>
                    </div>
                    <div class="flex md:flex-row flex-col items-stretch gap-3  mt-5 md:mt-0">
                        <a href="" class="uppercase bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold text-center">
                            Candidatos
                        </a>
                        <a href="{{ route('vacantes.edit', $vacante->id) }}" class="uppercase bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold text-center">
                            Editar
                        </a>
                        <!-- USAMOS dispatch PARA EMITIR UN EVENTO -->
                        <buttton wire:click="$dispatch('mostrarAlerta', {{ $vacante->id }})" class="uppercase bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold text-center cursor-pointer">
                            Eliminar
                        </buttton>
                    </div>
                </div>
            @endforeach
        @else
            <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
                <p class="text-center text-sm text-gray-600 font-bold">No hay vacantes</p>
            </div>
        @endif
    </div>

    <div class="mt-10">
        {{
            $vacantes->links()
        }}
    </div>
</div>

<!-- SCRIPTS DE SWEETALERT -->
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        Livewire.on('mostrarAlerta', vacanteId => {
            Swal.fire({
                title: "¿Deseas eliminar esta vacante?",
                text: "¡No podras revertir esta accion!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, ¡Eliminar!",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Emitir el evento para eliminar la vacante
                    Livewire.dispatch('eliminarVacante', { vacanteId: vacanteId} );
                    Swal.fire({
                        title: "Eliminado!",
                        text: "La vacante ha sido eliminada.",
                        icon: "success"
                    });
                }
            });
        })
    </script>
@endpush