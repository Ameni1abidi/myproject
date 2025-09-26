<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un Stagiaire') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <!-- Affichage des erreurs -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire pour ajouter un stagiaire -->
        <form method="POST" action="{{ route('stagiaires.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="entreprise">Entreprise</label>
                <input type="text" name="entreprise" id="entreprise" class="form-control" value="{{ old('entreprise') }}">
            </div>

            <div class="form-group">
                <label for="statut">Statut</label>
                <select name="statut" id="statut" class="form-control">
                    <option value="En attente" {{ old('statut') == 'En attente' ? 'selected' : '' }}>En attente</option>
                    <option value="En cours" {{ old('statut') == 'En cours' ? 'selected' : '' }}>En cours</option>
                    <option value="Terminé" {{ old('statut') == 'Terminé' ? 'selected' : '' }}>Terminé</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
        </form>
    </div>
</x-app-layout>
