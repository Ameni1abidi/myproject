<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion des utilisateurs
        </h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-3">Ajouter un utilisateur</a>
    </x-slot>

    <style>
        /* Improved CSS for admin users index */

        :root {
            --primary-color: #7c3aed; /* violet */
            --primary-hover: #6d28d9; /* darker violet */
            --success-color: #8b5cf6; /* lighter violet */
            --success-hover: #7c3aed; /* violet */
            --table-header-bg: #1f2937; /* dark gray/black */
            --table-row-odd-bg: #111827; /* darker black */
            --table-row-hover-bg: #3b82f6; /* bright violet-blue */
            --font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .btn-success {
            background-color: var(--success-color);
            color: #f3f4f6; /* light gray */
            border-radius: 0.375rem;
            padding: 0.5rem 1.25rem;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-block;
            text-align: center;
            text-decoration: none;
        }

        .btn-success:hover,
        .btn-success:focus {
            background-color: var(--success-hover);
            outline: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: #f3f4f6; /* light gray */
            border-radius: 0.375rem;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-block;
            text-align: center;
            text-decoration: none;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: var(--primary-hover);
            outline: none;
        }

        .table {
            width: 100%;
            margin-top: 1.25rem;
            border-radius: 0.5rem;
            border-collapse: separate;
            border-spacing: 0;
            box-shadow: 0 2px 8px rgba(124, 58, 237, 0.5);
            font-family: var(--font-family);
            background-color: #1f2937; /* dark background */
            color: #e0e7ff; /* light text */
        }

        .table th,
        .table td {
            padding: 0.75rem 1rem;
            text-align: left;
            font-size: 1rem;
            border-bottom: 1px solid #4c1d95; /* violet border */
            vertical-align: middle;
        }

        .table thead {
            background-color: var(--table-header-bg);
            color: #ddd6fe; /* light violet */
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .table tbody tr:nth-child(odd) {
            background-color: var(--table-row-odd-bg);
        }

        .table tbody tr:hover {
            background-color: var(--table-row-hover-bg);
            cursor: pointer;
        }

        .alert-success {
            background-color: var(--success-color);
            color: #f3f4f6; /* light gray */
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1.25rem;
            font-size: 1.125rem;
            font-weight: 600;
            font-family: var(--font-family);
        }

        .container {
            padding: 1.5rem 2rem;
            background-color: #111827; /* dark background */
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.5);
            font-family: var(--font-family);
            color: #ddd6fe; /* light violet text */
        }

        @media (max-width: 768px) {
            .table,
            .table thead,
            .table tbody,
            .table th,
            .table td,
            .table tr {
                display: block;
            }

            .table thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            .table tr {
                margin-bottom: 1rem;
                border-radius: 0.5rem;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                padding: 1rem;
                background-color: white;
            }

            .table td {
                border: none;
                position: relative;
                padding-left: 50%;
                text-align: right;
                font-size: 0.9rem;
                border-bottom: 1px solid #e5e7eb;
            }

            .table td::before {
                position: absolute;
                top: 50%;
                left: 1rem;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                transform: translateY(-50%);
                font-weight: 700;
                text-align: left;
                content: attr(data-label);
                color: #6b7280;
            }
        }
    </style>

    <div class="container mt-4">
        <h2 class="mb-4">Liste des utilisateurs</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->getRoleNames()->implode(', ') }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">Modifier les rôles</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
