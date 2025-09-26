
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Affectation des Stagiaires aux Tuteurs') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="font-semibold text-xl text-gray-800 leading-tight">
                <h5>Affecter un Stagiaire à un Tuteur</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.affectations.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="stagiaire_id" class="form-label">Stagiaire</label>
                        <select name="stagiaire_id" id="stagiaire_id" class="form-control" required>
                            <option value="">Sélectionner un stagiaire</option>
                            @foreach($stagiaires as $stagiaire)
                                <option value="{{ $stagiaire->id }}">{{ $stagiaire->user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
    <label for="tuteur_id" class="form-label">Tuteur</label>
    <select name="tutor_id" id="tuteur_id" class="form-control" required> <!-- Modifié ici pour 'tutor_id' -->
        <option value="">Sélectionner un tuteur</option>
        @foreach ($tutors as $tutor)
            <option value="{{ $tutor->id }}">{{ $tutor->name }}</option>
        @endforeach
    </select>
</div>

                    <button type="submit" class="btn btn-primary">Affecter</button>
                </form>
            </div>
        </div>


        
    </div>
</x-app-layout>
