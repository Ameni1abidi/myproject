<x-app-layout>
    <div class="container">
        <h2 class="text-2xl font-semibold mb-4">Modifier le stage</h2>

        <form action="{{ route('stages.update', $stage->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="user_id">Stagiaire</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="">Sélectionner un stagiaire</option>
                    @foreach ($stagiaires as $stagiaire)
                        <option value="{{ $stagiaire->id }}" 
                                @if($stagiaire->id == $stage->user_id) selected @endif>
                            {{ $stagiaire->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="entreprise_id">Entreprise</label>
                <select name="entreprise_id" id="entreprise_id" class="form-control" required>
                    <option value="">Sélectionner une entreprise</option>
                    @foreach ($entreprises as $entreprise)
                        <option value="{{ $entreprise->id }}" 
                                @if($entreprise->id == $stage->entreprise_id) selected @endif>
                            {{ $entreprise->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="date_debut">Date de début</label>
                <input type="date" name="date_debut" id="date_debut" class="form-control" value="{{ $stage->date_debut }}" required>
            </div>

            <div class="form-group">
                <label for="date_fin">Date de fin</label>
                <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ $stage->date_fin }}" required>
            </div>

            <div class="form-group">
                <label for="statut">Statut</label>
                <select name="statut" id="statut" class="form-control" required>
                    <option value="disponible" @if($stage->statut == 'disponible') selected @endif>Disponible</option>
                    <option value="en cours" @if($stage->statut == 'en cours') selected @endif>En cours</option>
                    <option value="terminé" @if($stage->statut == 'terminé') selected @endif>Terminé</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Mettre à jour le stage</button>
        </form>
    </div>

    <!-- CSS pour personnalisation -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin-top: 50px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            font-weight: bold;
            color: #555;
        }

        .form-control {
            border-radius: 0.375rem;
            box-shadow: none;
            border: 1px solid #ccc;
            padding: 10px;
            width: 100%;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</x-app-layout>
