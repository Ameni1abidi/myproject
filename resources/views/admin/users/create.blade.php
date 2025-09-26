<x-app-layout>
    <style>
        /* New light theme with card layout and floating labels */

        :root {
            --primary-color: #7c3aed; /* violet */
            --primary-hover: #6d28d9; /* darker violet */
            --success-color: #8b5cf6; /* lighter violet */
            --success-hover: #7c3aed; /* violet */
            --secondary-color: #1f2937; /* dark gray/black */
            --secondary-hover: #111827; /* darker black */
            --error-color: #ef4444; /* Red */
            --error-bg: #fca5a5;
            --font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            --background-color: #111827; /* black background */
            --card-background: #1f2937; /* dark card background */
            --text-color: #ddd6fe; /* light violet text */
            --input-bg: #1f2937; /* dark input background */
            --input-border: #4c1d95; /* violet border */
            --input-focus-border: var(--primary-color);
        }

        body {
            font-family: var(--font-family);
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .container {
            max-width: 700px;
            margin: 3rem auto;
            padding: 2rem 3rem;
            background-color: var(--card-background);
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(124, 58, 237, 0.2);
        }

        h2 {
            font-size: 2.25rem;
            margin-bottom: 2rem;
            font-weight: 700;
            text-align: left;
            color: var(--primary-color);
        }

        .alert-danger {
            background-color: var(--error-bg);
            color: var(--error-color);
            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .alert-danger ul {
            list-style: disc inside;
            margin: 0;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem 2rem;
        }

        .form-group {
            position: relative;
            margin-bottom: 1rem;
            grid-column: span 2;
        }

        label {
            position: absolute;
            top: 0.75rem;
            left: 1rem;
            font-size: 1rem;
            color: #ddd6fe;
            background-color: var(--card-background);
            padding: 0 0.25rem;
            pointer-events: none;
            transition: 0.2s ease all;
        }

        input.form-control,
        select.form-control {
            width: 100%;
            padding: 1.25rem 1rem 0.5rem 1rem;
            border: 1px solid var(--input-border);
            border-radius: 0.75rem;
            background-color: var(--input-bg);
            color: var(--text-color);
            font-size: 1rem;
            font-family: var(--font-family);
            transition: border-color 0.3s ease;
        }

        input.form-control:focus,
        select.form-control:focus {
            outline: none;
            border-color: var(--input-focus-border);
            box-shadow: 0 0 8px var(--primary-color);
        }

        input.form-control:focus + label,
        input.form-control:not(:placeholder-shown) + label,
        select.form-control:focus + label,
        select.form-control:not(:placeholder-shown) + label {
            top: -0.6rem;
            left: 0.75rem;
            font-size: 0.75rem;
            color: var(--primary-color);
            font-weight: 700;
        }

        select.form-control[multiple] {
            padding-top: 1rem;
            min-height: 140px;
        }

        .btn-group {
            grid-column: span 2;
            display: flex;
            justify-content: flex-start;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        button.btn-success {
            background-color: var(--success-color);
            border: none;
            color: var(--text-color);
            font-weight: 700;
            padding: 0.75rem 2.5rem;
            font-size: 1.125rem;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 8px rgba(124, 58, 237, 0.6);
            text-shadow: 0 0 6px rgba(255, 255, 255, 0.4);
        }

        button.btn-success:hover {
            background-color: var(--success-hover);
            box-shadow: 0 6px 14px rgba(124, 58, 237, 0.8);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.6);
        }

        a.btn-secondary {
            background-color: var(--secondary-color);
            color: var(--text-color);
            text-decoration: none;
            padding: 0.75rem 2.5rem;
            border-radius: 0.75rem;
            font-weight: 700;
            font-size: 1.125rem;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(107, 114, 128, 0.5);
        }

        a.btn-secondary:hover {
            background-color: var(--secondary-hover);
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(107, 114, 128, 0.8);
        }

        @media (max-width: 640px) {
            form {
                display: flex;
                flex-direction: column;
            }

            .form-group {
                grid-column: span 1;
            }

            .btn-group {
                justify-content: center;
            }
        }
    </style>

    <div class="container">
        <h2>Créer un nouvel utilisateur</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="form-group">
                <input type="text" name="name" id="name" class="form-control" placeholder=" " required>
                <label for="name">Nom</label>
            </div>

            <div class="form-group">
                <input type="email" name="email" id="email" class="form-control" placeholder=" " required>
                <label for="email">Email</label>
            </div>

            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control" placeholder=" " required>
                <label for="password">Mot de passe</label>
            </div>

            <div class="form-group">
                <select name="roles[]" id="roles" class="form-control" multiple required>
                    <option disabled>Choisissez les rôles</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                <label for="roles">Rôles</label>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-success">Créer</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Retour</a>
            </div>
        </form>
    </div>
</x-app-layout>
