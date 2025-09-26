<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Mes Stages') }}</div>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if($stages && $stages->isEmpty())
    <p>Aucun stage trouvé pour ce stagiaire.</p>
@elseif(!$stages)
    <p>Une erreur s'est produite en récupérant les stages.</p>
@else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('Nom du Stage') }}</th>
                <th>{{ __('Date Début') }}</th>
                <th>{{ __('Date Fin') }}</th>
                <th>{{ __('Entreprise') }}</th>
                <th>{{ __('Tuteur') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stages as $stage)
                <tr>
                    <td>{{ $stage->nom }}</td>
                    <td>{{ $stage->date_debut->format('d/m/Y') }}</td>
                    <td>{{ $stage->date_fin->format('d/m/Y') }}</td>
                    <td>{{ $stage->entreprise }}</td>
                    <td>{{ $stage->tuteur ? $stage->tuteur->name : 'Non affecté' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
