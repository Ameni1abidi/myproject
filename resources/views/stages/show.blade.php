<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails du Stage') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5>{{ $stage->entreprise->nom }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Titre :</strong> {{ $stage->titre }}</p>
                <p><strong>Stagiaire :</strong> {{ $stage->stagiaire->name }}</p>
                <p><strong>Tuteur :</strong> {{ $stage->tuteur ? $stage->tuteur->name : 'Aucun tuteur assigné' }}</p>
                <p><strong>Entreprise :</strong> {{ $stage->entreprise->nom }}</p>
                <p><strong>Date de début :</strong> {{ $stage->date_debut }}</p>
                <p><strong>Date de fin :</strong> {{ $stage->date_fin }}</p>
                <p><strong>Description :</strong> {{ $stage->description ?? 'Aucune description disponible' }}</p>
                <p><strong>Statut :</strong> {{ ucfirst($stage->statut) }}</p>
            </div>
        </div>
    </div>

    <!-- Ajout de CSS personnalisé -->
    <style>
        /* Style personnalisé pour la page */
        .container {
            padding: 20px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            font-size: 1.2rem;
            font-weight: bold;
            padding: 15px;
        }

        .card-body p {
            margin-bottom: 10px;
            font-size: 1rem;
        }

        .card-body strong {
            color: #333;
        }

        .bg-dark {
            background-color: #343a40 !important;
        }

        .text-white {
            color: #fff !important;
        }
    </style>
</x-app-layout>
