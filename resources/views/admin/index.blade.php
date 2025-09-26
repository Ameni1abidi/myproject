<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestion des Administrateurs') }}
            </h2>
            <a href="{{ route('admin.create') }}" class="btn btn-success">Ajouter un Administrateur</a>
        </div>
    </x-slot>

    <div class="container mt-5">
        <h2>Liste des Administrateurs</h2>

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
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $admin->user->name }}</td>
                        <td>{{ $admin->user->email }}</td>
                        <td>{{ $admin->phone_number }}</td>
                        <td>
                            <a href="{{ route('admin.show', $admin->id) }}" class="btn btn-info">Voir</a>
                            <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-primary">Modifier</a>
                            <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            {{ $admins->links() }}
        </div>
    </div>
</x-app-layout>
