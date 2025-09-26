<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <!-- Ajouter le CSS personnalisé -->
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            background-color: #4c51bf;
            color: white;
            padding: 1rem 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .dashboard-card {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
        }

        .dashboard-card .title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 1rem;
        }

        .dashboard-card .message {
            font-size: 1rem;
            color: #4a5568;
        }

        .bg-gray-900 {
            color: #1a202c;
        }

        .py-12 {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        .shadow-sm {
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
    </style>
</x-app-layout>
