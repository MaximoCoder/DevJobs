<div class="p-10">
    <div class="mb-5">
        <h3 class="text-3xl font-bold text-gray-800 my-3">
            {{ $vacante->titulo }}
        </h3>
        <div class="md:grid md:grid-cols-2 bg-gray-50 p-4 my-5">
            <p class="font-bold text-sm uppercase text-gray-800 my-3">Empresa: <span class="font-normal normal-case">{{ $vacante->empresa }}</span></p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Ultimo dia para postularse: <span class="font-normal normal-case">{{ $vacante->ultimo_dia->toFormattedDateString() }}</span></p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Categoria: <span class="font-normal normal-case">{{ $vacante->categoria->categoria }}</span></p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Salario: <span class="font-normal normal-case">{{ $vacante->salario->salario }}</span></p>
        </div>
    </div>
    
    <div class="md:grid md:grid-cols-6 gap-4">
        <div class="md:col-span-2">
            <img src="{{ asset('storage/vacantes/'.$vacante->imagen) }}" alt="{{'Imagen de la vacante' . $vacante->titulo }}">
        </div>
        <div class="md:col-span-4">
            <h2 class="text-2xl font-bold mb-5">Descripcion del Puesto</h2>
            <p>{{ $vacante->descripcion }}</p>
        </div>
    </div>
    @guest
        <div class="mt-5 bg-gray-50 border border-dashed p-5 text-center">
            <p>¿Deseas aplicar a esta vacante?<a href="{{ route('register')}}" class="font-bold text-indigo-600"> Crea una cuenta y aplica a esta y a otras vacantes</a></p>
        </div>
    @endguest
    @auth
            <!-- Cannot para unicamente mostrar a los usuarios que no son reclutadores--> 
        @cannot('create', App\Models\Vacante::class)
            <!-- Componente para aplicar a la vacante --> 
            <livewire:postular-vacante :vacante="$vacante" />
        @endcannot
    @endauth
</div>
