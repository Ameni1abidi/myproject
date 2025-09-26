<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des Stagiaires') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Nom</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Entreprise</th>
                    <th class="border border-gray-300 px-4 py-2">Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stagiaires as $stagiaire)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $stagiaire->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $stagiaire->user ? $stagiaire->user->name : '' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $stagiaire->user ? $stagiaire->user->email : '' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $stagiaire->entreprise ?? '' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $stagiaire->statut ?? '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
