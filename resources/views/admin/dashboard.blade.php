<x-app-layout>
<x-slot name="header">
    <nav class="bg-gray-100 py-4">
        <div class="container mx-auto">
            <div class="flex flex-wrap items-center text-lg font-semibold text-blue-600 gap-4"> <!-- gap-4 pour espacer -->
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600">MyAdmin</a>
                <a href="{{ route('admin.users.index') }}" class="text-gray-700 hover:text-blue-600 transition {{ request()->routeIs('admin.users.index') ? 'text-blue-600 font-bold' : '' }}">Utilisateurs</a>
                <a href="{{ route('stagiaires.index') }}" class="text-gray-700 hover:text-blue-600 transition {{ request()->routeIs('stagiaires.index') ? 'text-blue-600 font-bold' : '' }}">Stagiaires</a>
                <a href="{{ route('tuteurs.index') }}" class="text-gray-700 hover:text-blue-600 transition {{ request()->routeIs('tuteurs.index') ? 'text-blue-600 font-bold' : '' }}">Tuteurs</a>
                <a href="{{ route('admin.affectations.index') }}" class="text-gray-700 hover:text-blue-600 transition {{ request()->routeIs('admin.affectations.index') ? 'text-blue-600 font-bold' : '' }}">Affectations</a>
                <a href="{{ route('admin.permissions.index') }}" class="text-gray-700 hover:text-blue-600 transition {{ request()->routeIs('admin.permissions.index') ? 'text-blue-600 font-bold' : '' }}">Permissions</a>
                <a href="{{ route('stages.index') }}" class="text-gray-700 hover:text-blue-600 transition {{ request()->routeIs('stages.index') ? 'text-blue-600 font-bold' : '' }}">Stages</a>
            </div>
        </div>
    </nav>
</x-slot>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="container mx-auto pt-28 pb-10"> 
        <div class="bg-white shadow-md rounded-2xl p-6">
            <div class="text-blue-600 font-semibold mb-4">Graphique des Stagiaires</div>
            <canvas id="stagiairesChart" class="w-full h-72"></canvas>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('stagiairesChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Stagiaires Inscrits',
                    data: @json($stagiairesData),
                    backgroundColor: 'rgba(214, 12, 255, 0.2)',
                    borderColor: 'rgb(183, 18, 224)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    
    <div class="container mx-auto py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow-md rounded-2xl p-6 hover:shadow-xl transition">
                <div class="text-blue-600 font-semibold mb-2 text-sm uppercase tracking-wide">Total Users</div>
                <div class="text-4xl font-bold text-gray-800">{{ $totalUsers }}</div>
            </div>
            <div class="bg-white shadow-md rounded-2xl p-6 hover:shadow-xl transition">
                <div class="text-green-600 font-semibold mb-2 text-sm uppercase tracking-wide">Total Stagiaires</div>
                <div class="text-4xl font-bold text-gray-800">{{ $totalStagiaires }}</div>
            </div>
            <div class="bg-white shadow-md rounded-2xl p-6 hover:shadow-xl transition">
                <div class="text-red-600 font-semibold mb-2 text-sm uppercase tracking-wide">Total Tuteurs</div>
                <div class="text-4xl font-bold text-gray-800">{{ $totalTuteurs }}</div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
            <div class="bg-white shadow-md rounded-2xl p-6 hover:shadow-xl transition">
                <div class="text-yellow-600 font-semibold mb-4 text-lg">Recent Stagiaires</div>
                <ul class="space-y-2">
                    @forelse($recentStagiaires as $stagiaire)
                        <li class="text-gray-700 text-lg">
                            {{ $stagiaire->user->name }} 
                            <span class="text-sm text-gray-500">({{ $stagiaire->entreprise ?? 'Sans entreprise' }})</span>
                        </li>
                    @empty
                        <li class="text-gray-500">Aucun stagiaire récent.</li>
                    @endforelse
                </ul>
            </div>

            <div class="bg-white shadow-md rounded-2xl p-6 hover:shadow-xl transition">
                <div class="text-indigo-600 font-semibold mb-4 text-lg">Recent Tuteurs</div>
                <ul class="space-y-2">
                    @forelse($recentTuteurs as $tuteur)
                        <li class="text-gray-700 text-lg">{{ $tuteur->name }}</li>
                    @empty
                        <li class="text-gray-500">Aucun tuteur récent.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
