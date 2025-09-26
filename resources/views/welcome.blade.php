<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Stagiaires</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-gradient-to-r from-gray-900 via-gray-800 to-black text-gray-100">

    <!-- HEADER -->
    <header class="glass py-4 shadow-md fixed top-0 left-0 w-full z-50">
        <div class="container mx-auto flex justify-between items-center px-6">
            <h1 class="text-2xl font-extrabold text-purple-400">Gestion des Stagiaires</h1>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="{{ route('login') }}" class="hover:text-purple-300 transition">Connexion</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-purple-300 transition">Inscription</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- MAIN -->
    <main class="py-20">
        <div class="container mx-auto px-6 text-center">

            <!-- Présentation -->
            <section class="mb-16">
                <h2 class="text-5xl font-extrabold text-purple-400">Plateforme de Gestion des Stagiaires</h2>
                <p class="mt-4 text-lg text-gray-300">Simplifiez la gestion des stages : suivi, évaluation et automatisation.</p>
                <a href="{{ route('register') }}" class="mt-6 inline-block bg-purple-500 text-white font-semibold px-8 py-3 rounded-full shadow-md hover:bg-purple-400 transition">
                    Commencer maintenant
                </a>
            </section>

            <!-- Fonctionnalités principales -->
            <section class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="glass p-6 rounded-xl shadow-lg transform hover:scale-105 transition">
                    <h3 class="text-xl font-bold text-purple-400">🛠 Gestion des Stagiaires</h3>
                    <p class="mt-2 text-gray-300">Ajoutez, modifiez et suivez les stagiaires.</p>
                </div>
                <div class="glass p-6 rounded-xl shadow-lg transform hover:scale-105 transition">
                    <h3 class="text-xl font-bold text-purple-400">📊 Suivi des Stages</h3>
                    <p class="mt-2 text-gray-300">Suivez les missions et la progression.</p>
                </div>
                <div class="glass p-6 rounded-xl shadow-lg transform hover:scale-105 transition">
                    <h3 class="text-xl font-bold text-purple-400">📑 Évaluations & Rapports</h3>
                    <p class="mt-2 text-gray-300">Consultez les retours et générez des rapports.</p>
                </div>
                <div class="glass p-6 rounded-xl shadow-lg transform hover:scale-105 transition">
                    <h3 class="text-xl font-bold text-purple-400">💬 Communication</h3>
                    <p class="mt-2 text-gray-300">Messagerie interne entre stagiaires et tuteurs.</p>
                </div>
                <div class="glass p-6 rounded-xl shadow-lg transform hover:scale-105 transition">
                    <h3 class="text-xl font-bold text-purple-400">📜 Génération de Documents</h3>
                    <p class="mt-2 text-gray-300">Automatisation des conventions et certificats.</p>
                </div>
                <div class="glass p-6 rounded-xl shadow-lg transform hover:scale-105 transition">
                    <h3 class="text-xl font-bold text-purple-400">📅 Gestion des Plannings</h3>
                    <p class="mt-2 text-gray-300">Organisation des stages et suivi des deadlines.</p>
                </div>
            </section>

            <!-- Statistiques -->
            <section class="mt-16 glass py-8 rounded-xl shadow-md">
                <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div>
                        <h4 class="text-5xl font-extrabold text-purple-400">150+</h4>
                        <p class="text-gray-300 text-lg">Stagiaires inscrits</p>
                    </div>
                    <div>
                        <h4 class="text-5xl font-extrabold text-purple-400">50+</h4>
                        <p class="text-gray-300 text-lg">Stages en cours</p>
                    </div>
                    <div>
                        <h4 class="text-5xl font-extrabold text-purple-400">20+</h4>
                        <p class="text-gray-300 text-lg">Tuteurs disponibles</p>
                    </div>
                </div>
            </section>

        </div>
    </main>

    <!-- FOOTER -->
    <footer class="glass py-6 mt-12 text-center">
        <p class="text-gray-300">&copy; 2025 Gestion des Stagiaires. Tous droits réservés.</p>
    </footer>

</body>
</html>
