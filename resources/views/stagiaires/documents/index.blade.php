<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Documents du Stagiaire') }}
        </h2>
    </x-slot>

    <div class="container">
        <h3>Ajouter un nouveau document</h3>
        <form action="{{ route('stagiaires.documents.store', $stagiaire) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="type">Type de document</label>
                <input type="text" name="type" id="type" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="document">Document</label>
                <input type="file" name="document" id="document" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success mt-3">Ajouter</button>
        </form>

        <h3 class="mt-5">Documents existants</h3>
        <ul>
            @foreach ($documents as $document)
                <li>
                    <strong>{{ $document->type }}</strong>
                    <a href="{{ route('stagiaires.documents.download', $document) }}" class="btn btn-link">Télécharger</a>
                    <form action="{{ route('stagiaires.documents.destroy', $document) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>