<?php

namespace views;

/**
 * Class LoginView
 * @package views
 * Cette classe permet de créer un formulaire de connexion
 * Elle contient une méthode toString qui permet de générer le formulaire de connexion
 * Elle contient un formulaire de connexion avec un champ pour l'identifiant et un champ pour le mot de passe
 * Elle contient un bouton pour envoyer le formulaire
 */
class LoginView
{
    /**
     * @return false|string
     */
    public function toString()
    {
        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Sub-er Eats</title>
            <link rel="stylesheet" href="../assets/css/app.css">
        </head>

        <form method="post" action="/annonces/index.php/annonces">
            <label for="login"> Votre identifiant </label> :
            <input type="text" name="login" id="login" placeholder="defaut" maxlength="12" required />
            <br />
            <label for="password"> Votre mot de passe </label> :
            <input type="password" name="password" id="password" maxlength="12" required />

            <input type="submit" value="Envoyer">
        </form>
        <?php
        return ob_get_clean();
    }
}