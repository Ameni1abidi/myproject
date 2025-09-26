<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Stagiaires</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px 12px; border: 1px solid #ddd; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h1>Liste des Stagiaires</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Entreprise</th>
                <th>Date de début</th>
                <th>Date de fin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stagiaires as $stagiaire)
            <tr>
                <td>{{ $stagiaire->name }}</td>
                <td>{{ $stagiaire->surname }}</td>
                <td>{{ $stagiaire->email }}</td>
                <td>{{ $stagiaire->entreprise }}</td>
                <td>{{ $stagiaire->start_date }}</td>
                <td>{{ $stagiaire->end_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
