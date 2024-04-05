<?php

class MainPage {

    function toString($menus): string
    {
        $html = '<!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Sub-er Eats</title>
            <link rel="stylesheet" href="../assets/css/app.css">
        </head>
        <body>
            <header>
                <h1>Bienvenue sur Sub-er Eats</h1>
                </header>

            <main>
                <section class="hero">
                    <h2>Bienvenue dans notre application de restauration en ligne !</h2>
                    <p>Découvrez nos délicieux plats et créez votre menu personnalisé en quelques clics.</p>
                    <a href="#" class="btn">Commencer</a>
                </section>';

        // Ajout des menus récupérés depuis l'API
        $html .= '<section class="featured-menus">
                    <h2>2 derniers menus créés</h2>';
        for ($i = 0; $i < 2; $i++) {
            $menu = $menus[$i];
            $html .= '<div class="menu-card">
                        <h3>' . $menu['userId'] . '\'s menu</h3>';
            foreach ($menu['dishes'] as $dish) {
                $html .= '<p>' . $dish['name'] . ': ' . $dish['price'] . ' €</p>';
            }
            $html .= '<a href="index.php?page=orders" class="btn">Commander</a>
                  </div>';
        }
        $html .= '</section>';

        $html .= '</main>

            <footer>
                <p>&copy; 2024 Sub-er Eats. Tous droits réservés.</p>
            </footer>

        </body>
        </html>';

        return $html;
    }
}