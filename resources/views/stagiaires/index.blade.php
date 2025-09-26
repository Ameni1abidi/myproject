<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestion des Stagiaires') }}
            </h2>
            <a href="{{ route('stagiaires.create') }}" class="btn btn-success">Ajouter un Stagiaire</a>
        </div>
    </x-slot>

    <div class="container mt-5">
        <h2 class="my-4">Tous les Stagiaires</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Entreprise</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stagiaires as $stagiaire)
                    <tr>
                        <td>{{ $stagiaire->id }}</td>
                        <td>{{ $stagiaire->user ? $stagiaire->user->name : 'Non spécifié' }}</td>
                        <td>{{ $stagiaire->user ? $stagiaire->user->email : 'Non spécifié' }}</td>
                        <td>{{ $stagiaire->entreprise ?? 'Non spécifiée' }}</td>
                        <td>{{ $stagiaire->statut ?? 'En attente' }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('stagiaires.show', $stagiaire->id) }}" class="btn btn-info">Voir</a>
                                <a href="{{ route('stagiaires.edit', $stagiaire->id) }}" class="btn btn-primary">Modifier</a>
                                <form action="{{ route('stagiaires.destroy', $stagiaire->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce stagiaire ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination mt-3">
            {{ $stagiaires->links() }}
        </div>

        <h2 class="my-4">Stagiaires Affectés à un Tuteur</h2>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Entreprise</th>
                    <th>Statut</th>
                    <th>Tuteur</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($stagiairesAffectes as $stagiaire)
                    <tr>
                        <td>{{ $stagiaire->id }}</td>
                        <td>{{ $stagiaire->user ? $stagiaire->user->name : 'Non spécifié' }}</td>
                        <td>{{ $stagiaire->user ? $stagiaire->user->email : 'Non spécifié' }}</td>
                        <td>{{ $stagiaire->entreprise ?? 'Non spécifiée' }}</td>
                        <td>{{ $stagiaire->statut ?? 'En attente' }}</td>
                        <td>{{ $stagiaire->tuteur ? $stagiaire->tuteur->name : 'Non affecté' }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- <div class="flex space-x-4 mb-4"> -->
    <!-- <a href="{{ route('stagiaires.exportExcel') }}" class="btn btn-success">Exporter en Excel</a> -->
    <!-- <a href="{{ route('stagiaires.exportPDF') }}" class="btn btn-danger">Exporter en PDF</a> -->
    <!-- </div> -->


        <!-- Pagination -->
        <div class="pagination mt-3">
            {{ $stagiairesAffectes->links() }}
        </div>
    </div>

    <style>
        /* CSS personnalisé */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
            color: #333;
        }

        .btn-group {
            display: flex;
            gap: 10px;
        }

        .btn-group .btn {
            padding: 8px 15px;
            font-size: 14px;
        }

        .btn-info {
            background-color: #17a2b8;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            margin: 0 5px;
            padding: 8px 16px;
            background-color: #f1f1f1;
            border-radius: 5px;
            text-decoration: none;
            color: #007bff;
        }

        .pagination a:hover {
            background-color: #007bff;
            color: white;
        }
    </style>
</x-app-layout>
