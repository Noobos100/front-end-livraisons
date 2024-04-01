<?php

function toString()
{
    return '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sub-er Eats</title>
    <link rel="stylesheet" href="app.css">
</head>
<body>
    <header>
        <h1>Bienvenue sur Sub-er Eats</h1>
        <nav>
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="#">Menus</a></li>
                <li><a href="#">Commander</a></li>
                <li><a href="#">À propos</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h2>Bienvenue dans notre application de restauration en ligne !</h2>
            <p>Découvrez nos délicieux plats et créez votre menu personnalisé en quelques clics.</p>
            <a href="#" class="btn">Commencer</a>
        </section>

        <section class="featured-menus">
            <h2>Nos Menus en Vedette</h2>
            <!-- Insérez ici des cartes représentant vos menus en vedette -->
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Votre Application de Restauration. Tous droits réservés.</p>
    </footer>

    <script src="scripts.js"></script>
</body>
</html>
';
}

echo toString();
