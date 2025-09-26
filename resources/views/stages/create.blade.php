<x-app-layout>
    <div class="container">
        <h2>Créer un nouveau stage</h2>

        <form action="{{ route('stages.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="stagiaire">Stagiaire</label>
                <select name="user_id" id="stagiaire" class="form-control">
                    @foreach($stagiaires as $stagiaire)
                        <option value="{{ $stagiaire->id }}">{{ $stagiaire->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="entreprise">Entreprise</label>
                <select name="entreprise_id" id="entreprise" class="form-control">
                    @foreach($entreprises as $entreprise)
                        <option value="{{ $entreprise->id }}">{{ $entreprise->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tutor">Tuteur</label>
                <select name="tutor_id" id="tutor" class="form-control">
                    @foreach($tuteurs as $tuteur)
                        <option value="{{ $tuteur->id }}">{{ $tuteur->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="date_debut">Date de début</label>
                <input type="date" name="date_debut" id="date_debut" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="date_fin">Date de fin</label>
                <input type="date" name="date_fin" id="date_fin" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="statut">Statut</label>
                <select name="statut" id="statut" class="form-control">
                    <option value="disponible">Disponible</option>
                    <option value="en cours">En cours</option>
                    <option value="terminé">Terminé</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success mt-3">Créer le stage</button>
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

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
</x-app-layout>
