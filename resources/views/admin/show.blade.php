<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de l\'Administrateur') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nom : {{ $admin->user->name }}</h5>
                <p class="card-text"><strong>Email :</strong> {{ $admin->user->email }}</p>
                <p class="card-text"><strong>Numéro de téléphone :</strong> {{ $admin->phone_number ?? 'Non renseigné' }}</p>
                <p class="card-text"><strong>Créé le :</strong> {{ $admin->created_at->format('d/m/Y H:i') }}</p>

                
                <a href="{{ route('admin.index') }}" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </div>
</x-app-layout>
