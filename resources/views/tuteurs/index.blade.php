<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestion des Tuteurs') }}
            </h2>
            <a href="{{ route('tuteurs.create') }}" class="btn btn-success">Ajouter un Tuteur</a>
        </div>
    </x-slot>

    <div class="container mt-5">
        <h2>Liste des Tuteurs</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tuteurs as $tuteur)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tuteur->user->name }}</td>
                        <td>{{ $tuteur->user->email }}</td>
                        <td>
                            <a href="{{ route('tuteurs.show', $tuteur->id) }}" class="btn btn-info">Voir</a>
                            <a href="{{ route('tuteurs.edit', $tuteur->id) }}" class="btn btn-primary">Modifier</a>
                            <form action="{{ route('tuteurs.destroy', $tuteur->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce tuteur ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $tuteurs->links() }}
        </div>
    </div>
</x-app-layout>
