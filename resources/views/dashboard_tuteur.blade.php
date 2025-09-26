<x-app-layout>
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Tableau de bord du tuteur</h2>

        @if(session('success'))
            <div class="alert alert-success bg-green-100 text-green-700 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <table class="table w-full table-auto bg-white shadow-md rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-700">Stagiaire</th>
                    <th class="px-4 py-2 text-left text-gray-700">Entreprise</th>
                    <th class="px-4 py-2 text-left text-gray-700">Date de début</th>
                    <th class="px-4 py-2 text-left text-gray-700">Date de fin</th>
                    <th class="px-4 py-2 text-left text-gray-700">Statut</th>
                    <th class="px-4 py-2 text-left text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stages as $stage)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">
                            @if($stage->stagiaire)
                                {{ $stage->stagiaire->name }}
                            @else
                                <span class="text-red-500">Stagiaire non assigné</span> - {{ $stage->stagiaire_id ?? 'Pas d\'ID stagiaire' }}
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $stage->entreprise->nom }}</td>
                        <td class="px-4 py-2">{{ $stage->date_debut }}</td>
                        <td class="px-4 py-2">{{ $stage->date_fin }}</td>
                        <td class="px-4 py-2">{{ ucfirst($stage->statut) }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('stagiaire_show', $stage->id) }}" class="btn btn-info bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none">
                                Détails
                            </a>
                        </td>
                    </tr>

                    <!-- Section des évaluations -->
                    <tr>
                        <td colspan="6" class="px-4 py-4">
                            <h4 class="text-xl font-semibold text-gray-800 mb-4">Évaluations précédentes pour {{ $stage->stagiaire->name }}</h4>
                            @if($stage->evaluations->isEmpty())
                                <p class="text-gray-500">Aucune évaluation pour ce stagiaire.</p>
                            @else
                                @foreach($stage->evaluations as $evaluation)
                                    <div class="evaluation mb-4 p-4 border-l-4 border-indigo-500 bg-gray-50">
                                        <p><strong class="font-semibold">Stagiaire :</strong> {{ $stage->stagiaire->name }}</p>
                                        <p><strong class="font-semibold">Tuteur :</strong> {{ $evaluation->tuteur->name }}</p>
                                        <p><strong class="font-semibold">Note :</strong> {{ $evaluation->note }}/20</p>
                                        <p><strong class="font-semibold">Commentaire :</strong> {{ $evaluation->commentaire ?: 'Aucun commentaire' }}</p>
                                        <p><strong class="font-semibold">Date de l\'évaluation :</strong> {{ \Carbon\Carbon::parse($evaluation->date_evaluation)->format('d/m/Y') }}</p>
                                    </div>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">Aucun stagiaire assigné.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Ajouter un peu de style CSS -->
    <style>
        .evaluation {
            background-color: #f7fafc;
            border-left: 4px solid #4c51bf;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0.375rem;
        }

        .evaluation p {
            margin: 0.5rem 0;
        }

        .btn-info {
            background-color: #4c51bf;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            text-align: center;
            display: inline-block;
        }

        .btn-info:hover {
            background-color: #434190;
        }
    </style>
</x-app-layout>
