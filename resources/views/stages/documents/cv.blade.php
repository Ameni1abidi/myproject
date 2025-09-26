<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Gestion des CV') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Upload/Download CV -->
                    <div class="mb-6">
                        <form action="{{ route('documents.upload.cv') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="flex gap-4">
                                <input type="file" name="cv" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                <x-primary-button>{{ __('Upload CV') }}</x-primary-button>
                            </div>
                        </form>
                    </div>

                    <!-- Liste des CV -->
                    @if($cvs->count() > 0)
                    <div class="mt-8">
                        <h3 class="mb-4 text-lg font-medium">CV Disponibles</h3>
                        <div class="space-y-3">
                            @foreach($cvs as $cv)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm text-gray-600">{{ $cv->file_name }}</span>
                                <a href="{{ route('documents.download', $cv) }}" class="text-blue-600 hover:text-blue-800">
                                    <x-icon.download class="w-5 h-5" />
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>