{{-- resources/views/tuteur/mes_stagiaires.blade.php --}}
<x-app-layout>
    <div class="container">
        <h1>Mes Stagiaires</h1>
        
        @if ($stagiaires->isEmpty())
            <p>Aucun stagiaire trouvé.</p>
        @else
            @foreach ($stagiaires as $stagiaire)
                <div>
                    <h3>{{ $stagiaire->user->name }}</h3>
                    <p>{{ $stagiaire->entreprise }}</p>
                    <p>{{ $stagiaire->statut }}</p>
                </div>
            @endforeach
        @endif
    </div>
</x-app-layout>
