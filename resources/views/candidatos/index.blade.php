<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Candidatos Vacante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold text-center mb-10">Candidatos Vacante: {{ $vacante->titulo }}</h1>
                    <div class="md:flex md:justify-center p-5">
                        <ul class="divide-y divide-gray-200 w-full">
                            @forelse ( $vacante->candidatos as $candidato )
                                <li class="p-3 flex items-center">
                                    <div class="flex-1">
                                        <p class="text-xl font-medium text-gray-800">{{ $candidato->user->name }}</p>
                                        <p class="text-sm  text-gray-800">{{ $candidato->user->email }}</p>
                                        <p class="text-sm font-medium text-gray-800">
                                            Dia que se postulo: <span class="font-bold">{{ $candidato->created_at->diffForHumans() }}</span>
                                        </p>
                                    </div>
                                    <div>
                                        <a href="{{ asset('storage/cv/'.$candidato->cv)  }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded" target="_blank" rel="noopener noreferrer">
                                            Ver CV
                                        </a>
                                    </div>
                                </li>
                            @empty
                                <p class="text-center p-3 text-sm text-gray-600">Todavia no hay ningun candidato.</p>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>