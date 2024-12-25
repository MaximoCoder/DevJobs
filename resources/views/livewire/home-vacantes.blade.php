<div>
    <!-- Componente para buscar -->
    <livewire:filtrar-vacantes />
    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <h3 class="font-extrabold text-4xl text-gray-700 mb-12">Nuestras Vacantes Disponibles</h3>

            <div class="bg-white shadow-sm rounded-lg p-6 divide-y divide-gray-200">
                @forelse ( $vacantes as  $vacante )
                    <div class="md:flex md:justify-between md:items-center py-5">
                        <div class="md:flex-1">
                            <a href="{{ route('vacantes.show', $vacante->id) }}" class="text-3xl font-extrabold text-gray-600">
                                {{ $vacante->titulo }}
                            </a>
                            <p class="text-gray-600 text-base mb-3">{{ $vacante->empresa }}</p>
                            <p>{{ $vacante->categoria->categoria }}</p>
                            <p>{{ $vacante->salario->salario }}</p>
                            <p>
                                Ultimo dia para postularse: <span class="font-bold">{{ $vacante->ultimo_dia->toFormattedDateString() }}</span>
                            </p>
                        </div>
                        <div class="mt-5 md:mt-0">
                            <a href="{{ route('vacantes.show', $vacante->id) }}" class="font-bold bg-indigo-600 text-sm uppercase p-3 text-white rounded-lg block text-center">
                                Ver Vacante
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="p-3 text-center text-sm text-gray-600">No hay vacantes disponibles</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
