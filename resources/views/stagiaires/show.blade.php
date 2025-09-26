<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails du Stagiaire') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>Nom:</strong> {{ $stagiaire->user->name ?? 'Non spécifié' }}</h3>
            </div>
            <div class="card-body">
                <p><strong>Email:</strong> {{ $stagiaire->user->email ?? 'Non spécifié' }}</p>
                <p><strong>Entreprise:</strong> {{ $stagiaire->entreprise ?? 'Non spécifiée' }}</p>
                <p><strong>Statut:</strong> {{ $stagiaire->statut ?? 'En attente' }}</p>
                <p><strong>Rapports:</strong></p>
                <ul class="list-group">
                    @if($stagiaire->rapports && count($stagiaire->rapports) > 0)
                        @foreach($stagiaire->rapports as $rapport)
                            <li class="list-group-item">{{ $rapport->title }} - {{ $rapport->date }}</li>
                        @endforeach
                    @else
                        <li class="list-group-item">Aucun rapport disponible</li>
                    @endif
                </ul>
                <p><strong>CV:</strong>
    @if($stagiaire->cv)
        <a href="{{ \Illuminate\Support\Facades\Storage::url($stagiaire->cv) }}" target="_blank">Télécharger le CV</a>
    @else
        Non spécifié
    @endif
</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('stagiaires.index') }}" class="btn btn-secondary">Retour à la liste</a>
            </div>
        </div>
    </div>
</x-app-layout>
