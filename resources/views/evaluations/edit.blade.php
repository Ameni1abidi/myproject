<x-app-layout>
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Modifier l'évaluation du stagiaire</h2>

        <form action="{{ route('evaluation.update', $stage->id) }}" method="POST">
    @csrf
    @method('PUT') <!-- Cette ligne permet de simuler une méthode PUT pour la mise à jour -->

    <!-- Champs du formulaire -->
    <div class="mb-4">
        <label for="note" class="block text-gray-700">Note (sur 20)</label>
        <input type="number" name="note" id="note" value="{{ old('note', $evaluation->note) }}" class="mt-2 block w-full px-4 py-2 border rounded-lg" required min="0" max="20">
    </div>

    <div class="mb-4">
        <label for="commentaire" class="block text-gray-700">Commentaire</label>
        <textarea name="commentaire" id="commentaire" class="mt-2 block w-full px-4 py-2 border rounded-lg">{{ old('commentaire', $evaluation->commentaire) }}</textarea>
    </div>

    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none">Mettre à jour l'évaluation</button>
</form>

    </div>
</x-app-layout>
