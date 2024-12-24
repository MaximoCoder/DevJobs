<form action="" class="md:w-1/2 space-y-5" wire:submit.prevent="crearVacante">
    @csrf

    <!-- Titulo -->
    <div>
        <x-input-label for="titulo" :value="__('Titulo')" />
        <x-text-input id="titulo" class="block mt-1 w-full" type="text" wire:model="titulo" :value="old('titulo')" placeholder="Titulo de la vacante" />
        <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
    </div>
    <!-- Salario -->
    <div>
        <x-input-label for="salario" :value="__('Salario Mensual')" />
        <select id="salario" wire:model="salario" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
            <option value="">--- Seleccione una opción ---</option>
            @foreach ($salarios as $salario)
            <option value="{{ $salario->id }}">{{ $salario->salario }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('salario')" class="mt-2" />
    </div>

    <!-- Categoria -->
    <div>
        <x-input-label for="categoria" :value="__('Categoria')" />
        <select id="categoria" wire:model="categoria" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
            <option value="">--- Seleccione una opción ---</option>
            @foreach ( $categorias as $categoria )
                <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
    </div>

    <!-- Empresa -->
    <div>
        <x-input-label for="empresa" :value="__('Nombre de la empresa')" />
        <x-text-input id="empresa" class="block mt-1 w-full" type="text" wire:model="empresa" :value="old('empresa')" placeholder="Empresa: Ej. Google, Microsoft" />
        <x-input-error :messages="$errors->get('empresa')" class="mt-2" />
    </div>

    <!-- Ultimo dia para aplicar -->
    <div>
        <x-input-label for="ultimo_dia" :value="__('Ultimo dia para aplicar')" />
        <x-text-input id="ultimo_dia" class="block mt-1 w-full" type="date" wire:model="ultimo_dia" :value="old('ultimo_dia')" />
        <x-input-error :messages="$errors->get('ultimo_dia')" class="mt-2" />
    </div>

    <!-- Descripcion de la vacante -->
    <div>
        <x-input-label for="descripcion" :value="__('Descripción de la vacante')" />
        <textarea wire:model="descripcion" id="descripcion" placeholder="Descripción de la vacante" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full h-72"></textarea>
        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
    </div>
    <!-- IMAGEN -->
    <div>
        <x-input-label for="imagen" :value="__('Imagen')" />
        <x-text-input id="imagen" class="block mt-1 w-full" type="file" wire:model="imagen" accept="image/*" />
        <!-- Mostrar preview de la imagen -->
        <div class="my-5 w-80">
            @if ($imagen)
                Imagen Seleccionada:
                <br>
                <img src="{{ $imagen->temporaryUrl() }}">
            @endif
        </div>
        <x-input-error :messages="$errors->get('imagen')" class="mt-2" />
    </div>
    <!-- Boton -->
    <x-primary-button class="w-full justify-center">
        {{ __('Publicar Vacante') }}
    </x-primary-button>
</form>