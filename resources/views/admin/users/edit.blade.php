<x-app-layout>
    <style>
        :root {
            --primary-color: #7c3aed; /* violet */
            --primary-hover: #6d28d9; /* darker violet */
            --success-color: #8b5cf6; /* lighter violet */
            --success-hover: #7c3aed; /* violet */
            --error-color: #dc2626; /* red */
            --error-bg: #7f1d1d; /* dark red background */
            --font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            --background-color: #111827; /* dark background */
            --text-color: #ddd6fe; /* light violet text */
            --input-bg: #1f2937; /* input background */
            --input-border: #4c1d95; /* violet border */
            --input-focus-border: #7c3aed; /* violet focus */
        }

        .container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 1.5rem 2rem;
            background-color: var(--background-color);
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.5);
            font-family: var(--font-family);
            color: var(--text-color);
        }

        h2 {
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
            text-align: center;
        }

        .alert-danger {
            background-color: var(--error-bg);
            color: white;
            padding: 1rem 1.25rem;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .alert-danger ul {
            margin: 0;
            padding-left: 1.25rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 1rem;
        }

        select.form-control {
            width: 100%;
            background-color: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 0.375rem;
            color: var(--text-color);
            padding: 0.5rem 0.75rem;
            font-size: 1rem;
            font-family: var(--font-family);
            transition: border-color 0.3s ease;
            min-height: 120px;
        }

        select.form-control:focus {
            outline: none;
            border-color: var(--input-focus-border);
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.5);
        }

        button.btn-success {
            background-color: var(--success-color);
            color: var(--text-color);
            border: none;
            border-radius: 0.375rem;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto;
        }

        button.btn-success:hover,
        button.btn-success:focus {
            background-color: var(--success-hover);
            outline: none;
        }
    </style>

    <div class="container">
        <h2>Modifier les rôles de l'utilisateur</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="roles">Rôles</label>
                <select name="roles[]" id="roles" class="form-control" multiple>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" 
                                @if($user->hasRole($role->name)) selected @endif>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success mt-3">Mettre à jour les rôles</button>
        </form>
    </div>
</x-app-layout>
