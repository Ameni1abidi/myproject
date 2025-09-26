<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier un Administrateur') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <form action="{{ route('admin.update', $admin->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="name" class="form-control" value="{{ $admin->user->name }}" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $admin->user->email }}" required>
            </div>

            <div class="form-group">
                <label>Nouveau mot de passe (laisser vide si inchangé)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="form-group">
                <label>Numéro de téléphone</label>
                <input type="text" name="phone_number" class="form-control" value="{{ $admin->phone_number }}">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary mt-3">Annuler</a>
        </form>
    </div>
</x-app-layout>
