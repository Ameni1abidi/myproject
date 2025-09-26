<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier le Stagiaire') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <form method="POST" action="{{ route('stagiaires.update', $stagiaire->id) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')

                <!-- Nom -->
                <div>
                    <label for="name" class="block font-medium text-sm text-gray-700">Nom</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $stagiaire->user->name ?? '') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200" required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $stagiaire->user->email ?? '') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200" required>
                </div>

                <!-- Mot de passe -->
                <div>
                    <label for="password" class="block font-medium text-sm text-gray-700">Mot de passe (laisser vide pour ne pas changer)</label>
                    <input type="password" id="password" name="password"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                </div>

                <!-- Entreprise -->
                <div>
                    <label for="entreprise" class="block font-medium text-sm text-gray-700">Entreprise</label>
                    <input type="text" id="entreprise" name="entreprise" value="{{ old('entreprise', $stagiaire->entreprise) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                </div>

                <!-- Statut -->
                <div>
                    <label for="statut" class="block font-medium text-sm text-gray-700">Statut</label>
                    <select id="statut" name="statut"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                        <option value="En attente" {{ $stagiaire->statut == 'En attente' ? 'selected' : '' }}>En attente</option>
                        <option value="En cours" {{ $stagiaire->statut == 'En cours' ? 'selected' : '' }}>En cours</option>
                        <option value="Terminé" {{ $stagiaire->statut == 'Terminé' ? 'selected' : '' }}>Terminé</option>
                    </select>
                </div>

                <!-- CV -->
                <div>
                    <label for="cv" class="block font-medium text-sm text-gray-700">CV</label>
                    <input type="file" id="cv" name="cv"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                </div>

                <!-- Institution -->
                <div>
                    <label for="institution" class="block font-medium text-sm text-gray-700">Institution</label>
                    <input type="text" id="institution" name="institution" value="{{ old('institution', $stagiaire->institution) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                </div>

                <!-- Boutons -->
                <div class="flex justify-between items-center pt-4">
                <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
                    <a href="{{ route('stagiaires.index') }}"
                        class="text-gray-600 hover:underline">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
