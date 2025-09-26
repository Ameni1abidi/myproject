<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Suivi des Stages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Contenu du suivi -->
                    <div class="mb-4">
                        <h3 class="text-lg font-medium">Stages en cours</h3>
                        <ul class="mt-4 space-y-4">
                            @foreach($internships as $internship)
                            <li class="p-4 border rounded-lg">
                                <div class="flex justify-between">
                                    <div>
                                        <p class="font-semibold">{{ $internship->title }}</p>
                                        <p class="text-sm text-gray-600">{{ $internship->company->name }}</p>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $internship->start_date->format('d/m/Y') }} - {{ $internship->end_date->format('d/m/Y') }}
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>