<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un Administrateur') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <form action="{{ route('admin.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Numéro de téléphone</label>
                <input type="text" name="phone_number" class="form-control">
            </div>

            <button type="submit" class="btn btn-success mt-3">Ajouter</button>
        </form>
    </div>
</x-app-layout>
