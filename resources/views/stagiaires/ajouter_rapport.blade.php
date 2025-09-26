<x-app-layout>
<form action="{{ route('stagiaire.ajouter_rapport', $stage->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="contenu">Contenu du rapport (PDF):</label>
        <input type="file" name="contenu" id="contenu" required>
    </div>
    <div>
        <label for="date">Date :</label>
        <input type="date" name="date" id="date" required>
    </div>
    <button type="submit">Ajouter le rapport</button>
</form>

</x-app-layout>