<?php

function fetchMenusFromAPI() {
    $api_url = 'https://660eeb4a356b87a55c5074b6.mockapi.io/api/v1/plat';
    $menus_json = file_get_contents($api_url);
    $menus = json_decode($menus_json, true);
    return $menus;
}

function toString() {
    $menus = fetchMenusFromAPI();

    $html = '<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sub-er Eats</title>
        <link rel="stylesheet" href="assets/css/app.css">
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
            </section>';

    // Ajout des menus récupérés depuis l'API
    $html .= '<section class="featured-menus">
                    <h2>Nos Menus en Vedette</h2>';
    foreach ($menus as $menu) {
        $html .= '<div class="menu-card">
                        <h3>' . $menu['name'] . '</h3>
                        <p>' . $menu['description'] . '</p>
                        <p>Prix: ' . $menu['price'] . ' €</p>
                    </div>';
    }
    $html .= '</section>';

    $html .= '</main>

        <footer>
            <p>&copy; 2024 Votre Application de Restauration. Tous droits réservés.</p>
        </footer>

        <script src="assets/js/scripts.js"></script>
    </body>
    </html>';

    return $html;
}

echo toString();
