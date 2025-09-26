<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails du Tuteur') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <h2>{{ $tuteur->user->name }}</h2>
        <p><strong>Email:</strong> {{ $tuteur->user->email }}</p>
        <p><strong>Téléphone:</strong> {{ $tuteur->phone }}</p>
        <p><strong>Adresse:</strong> {{ $tuteur->address }}</p>
        <a href="{{ route('tuteurs.index') }}" class="btn btn-secondary">Retour</a>
    </div>
</x-app-layout>
