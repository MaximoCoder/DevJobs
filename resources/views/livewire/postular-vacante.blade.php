<div class="bg-gray-100 p-5 mt-10 flex flex-col justify-center items-center">
    <h3 class="text-center text-2xl font-bold my-4">Postularme a esta vacante</h3>

    <!-- Validar si hay mensajes de exito -->
    @if(session()->has('mensaje'))
        <p class="uppercase border border-green-600 bg-green-100 text-green-600 font-bold p-2 my-5 text-sm rounded-lg">
            {{ session('mensaje') }}
        </p>

    @else
        <!-- En el caso de que no hay mensaje, no ha aplicado a la vacante -->
        <form wire:submit.prevent="postularme" class="w-96 mt-5">
            @csrf
    
            <!-- CV -->
            <div>
                <x-input-label for="cv" :value="__('Curriculum Vitae')" />
                <x-text-input id="cv" class="block mt-1 w-full" type="file" wire:model="cv" name="cv" accept=".pdf"  />
                <x-input-error :messages="$errors->get('cv')" class="mt-2" />
            </div>
    
            <!-- Boton -->
            <x-primary-button class="my-5 w-full justify-center">
                {{ __('Postularme') }}
            </x-primary-button>
        </form>
    @endif
    
</div>
