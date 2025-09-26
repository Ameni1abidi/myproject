<x-app-layout>
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Détails du stagiaire</h2>

        <!-- Carte des détails du stagiaire -->
        <div class="bg-gray-100 p-6 rounded-lg shadow-md">
            <div class="card-body">
                <h4 class="text-xl font-semibold text-indigo-600 mb-4">
                    @if($stage->stagiaire)
                        {{ $stage->stagiaire->name }}
                    @else
                        <span class="text-red-500">Stagiaire non assigné</span>
                    @endif
                </h4>
                <p class="text-gray-700"><strong>Entreprise :</strong> {{ $stage->entreprise->nom }}</p>
                <p class="text-gray-700"><strong>Date de début :</strong> {{ $stage->date_debut }}</p>
                <p class="text-gray-700"><strong>Date de fin :</strong> {{ $stage->date_fin }}</p>
                <p class="text-gray-700"><strong>Statut :</strong> {{ ucfirst($stage->statut) }}</p>
            </div>
        </div>

        <!-- Section des rapports hebdomadaires -->
        <h3 class="mt-8 text-2xl font-semibold text-gray-800">Rapports Hebdomadaires</h3>
        <ul class="list-group mt-4">
            @foreach($stage->rapports as $rapport)
                <li class="list-group-item bg-gray-50 p-4 rounded-lg shadow-md mb-2">
                    <strong class="text-indigo-600">{{ $rapport->date }}</strong>:
                    <a href="{{ Storage::url($rapport->contenu) }}" class="text-blue-600 hover:text-blue-800" target="_blank">Voir le rapport PDF</a>
                </li>
            @endforeach
            @if($stage->rapports->isEmpty())
                <li class="list-group-item bg-gray-50 p-4 rounded-lg shadow-md mb-2 text-gray-500">Aucun rapport soumis.</li>
            @endif
        </ul>

        <!-- Formulaire d'évaluation -->
        <h3 class="mt-8 text-2xl font-semibold text-gray-800">Évaluer le stagiaire</h3>
        <form action="{{ route('evaluer_stage', $stage->id) }}" method="POST" class="mt-4">
            @csrf
            <div class="form-group mb-6">
                <label for="note" class="text-lg text-gray-700">Note (sur 20)</label>
                <input type="number" id="note" name="note" class="form-control mt-2 p-3 border-2 border-gray-300 rounded-md focus:outline-none focus:border-indigo-500" min="0" max="20" required>
            </div>
            <div class="form-group mb-6">
                <label for="commentaire" class="text-lg text-gray-700">Commentaire</label>
                <textarea id="commentaire" name="commentaire" class="form-control mt-2 p-3 border-2 border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-4 bg-indigo-600 text-white py-2 px-6 rounded-md hover:bg-indigo-700 focus:outline-none">Soumettre l'évaluation</button>
        </form>
    </div>

    <!-- Ajouter un peu de style CSS -->
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .list-group {
            list-style-type: none;
            padding: 0;
        }
        .list-group-item {
            margin-bottom: 0.5rem;
        }
        .form-group label {
            font-weight: 600;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border-radius: 0.375rem;
            border: 1px solid #d1d5db;
        }
        .form-control:focus {
            border-color: #4c51bf;
            outline: none;
        }
        .btn-primary {
            background-color: #4c51bf;
            color: white;
        }
        .btn-primary:hover {
            background-color: #3b45a1;
        }
    </style>
</x-app-layout>
