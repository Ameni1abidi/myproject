<x-app-layout>
    <div class="container">
        <h2 class="text-2xl font-semibold mb-4">Liste des stages disponibles</h2>

        <a href="{{ route('stages.create') }}" class="btn btn-primary mb-3">Créer un stage</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Stagiaire</th>
                    <th>Entreprise</th>
                    <th>Tuteur</th> <!-- Nouvelle colonne pour le tuteur -->
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stages as $stage)
                <tr>
                    <td>{{ $stage->id }}</td>
                    <td>{{ $stage->user->name }}</td> <!-- Modification pour utiliser 'user' pour le stagiaire -->
                    <td>
                        @if($stage->entreprise)
                            {{ $stage->entreprise->nom }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $stage->tuteur ? $stage->tuteur->name : 'N/A' }}</td> <!-- Correction de 'tutor' en 'tuteur' -->
                    <td>{{ $stage->date_debut }}</td>
                    <td>{{ $stage->date_fin }}</td>
                    <td>{{ $stage->statut }}</td>
                    <td>
                        <a href="{{ route('stages.show', $stage->id) }}" class="btn btn-info">Voir</a> <!-- Lien "Voir" -->
                        <a href="{{ route('stages.edit', $stage->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('stages.destroy', $stage->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Aucun stage disponible.</td> <!-- Mise à jour du colspan -->
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Ajout du CSS -->
    <style>
        .container {
            padding: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .btn {
            padding: 8px 12px;
            margin-right: 5px;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .btn-info {
            background-color: #17a2b8;
            color: white;
        }

        .btn-warning {
            background-color: #ffc107;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .alert-success {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border-radius: 4px;
        }
    </style>
</x-app-layout>
