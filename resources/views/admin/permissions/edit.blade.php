<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier les Permissions de {{ $user->name }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <form action="{{ route('admin.permissions.update', $user->id) }}" method="POST">
            @csrf
            <h3>Permissions disponibles</h3>

            <div class="form-group">
                @foreach($permissions as $permission)
                    <div class="form-check">
                        <input 
                            type="checkbox" 
                            class="form-check-input" 
                            name="permissions[]" 
                            value="{{ $permission->name }}" 
                            id="perm_{{ $permission->id }}"
                            {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="perm_{{ $permission->id }}">{{ $permission->name }}</label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-success mt-3">Mettre à jour</button>
        </form>
    </div>
</x-app-layout>
