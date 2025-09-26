<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de Bord du Stagiaire') }}
        </h2>
    </x-slot>

    <style>
        .card {
            border: 2px solid #4a5568;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 25px;
            background-color: #edf2f7;
        }
        .card-header {
            background-color: #2d3748;
            color: #fff;
            border-bottom: 2px solid #4a5568;
            padding: 15px 20px;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .card-body {
            padding: 20px;
        }
        .btn-primary {
            background-color: #3182ce;
            border-color: #3182ce;
            color: #fff;
            padding: 5px 10px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
        }
        .btn-secondary {
            background-color: #718096;
            border-color: #718096;
            color: #fff;
            padding: 5px 10px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
        }
        .container {
            max-width: 1100px;
            margin: 0 auto;
        }
    </style>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5>Mes Informations</h5>
            </div>
            <div class="card-body">
                @if ($stagiaire)
                    <p><strong>Nom :</strong> {{ $stagiaire->user->name }}</p>
                    <p><strong>Email :</strong> {{ $stagiaire->user->email }}</p>
                    <p><strong>Entreprise :</strong> {{ $stagiaire->entreprise ?? 'Non spécifiée' }}</p>
                    <p><strong>Statut :</strong> {{ $stagiaire->statut ?? 'En attente' }}</p>
                    <a href="{{ route('stagiaires.edit', $stagiaire->id) }}" class="btn btn-primary">Modifier mes informations</a>
                @else
                    <p>Aucune information sur le stagiaire disponible.</p>
                @endif

                <hr>

                <h5>Mon Tuteur</h5>
                @if ($tuteur)
                    <p><strong>Nom :</strong> {{ $tuteur->name }}</p>
                    <p><strong>Email :</strong> {{ $tuteur->email }}</p>
                @else
                    <p>Aucun tuteur assigné.</p>
                @endif

                <hr>

                <h5>Mon CV</h5>
                @if ($stagiaire && $stagiaire->cv)
                    <a href="{{ asset('storage/cvs/' . $stagiaire->cv) }}" target="_blank" class="btn btn-secondary">Voir mon CV</a>
                @else
                    <p>Aucun CV disponible.</p>
                @endif

                <hr>

                <h5>Mes évaluations</h5>
@if($evaluations->isEmpty())
    <p>Aucune évaluation disponible pour le moment.</p>
@else
    <div class="list-group">
        @foreach($evaluations as $evaluation)
            <div class="list-group-item">
                <h5><strong>Tuteur :</strong> {{ $evaluation->tuteur->name }}</h5>
                <p><strong>Note :</strong> {{ $evaluation->note }}/20</p>

                <!-- Affichage de la date de l'évaluation avec formatage -->
                <p><strong class="font-semibold">Date de l\'évaluation :</strong> {{ \Carbon\Carbon::parse($evaluation->date_evaluation)->format('d/m/Y') }}</p>
                <!-- Affichage conditionnel du commentaire -->
                @if($evaluation->commentaire)
                    <p><strong>Commentaire :</strong> {{ $evaluation->commentaire }}</p>
                @else
                    <p><strong>Commentaire :</strong> Aucun commentaire.</p>
                @endif
            </div>
        @endforeach
    </div>
@endif


        </div>
    </div>
</x-app-layout>
