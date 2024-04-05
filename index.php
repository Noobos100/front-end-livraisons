<?php
// Get the page from the query string
use views\CreateMenu;
use views\Login;
use views\Orders;

// Get the data from the API
use api\APIHandler;

// get APIHandler class
require_once __DIR__ . '/api/api/APIHandler.php';

// Define the path to the views folder
$page = $_GET['page'] ?? 'home';

// Define the path to the views folder
$viewsPath = __DIR__ . '/views/';

// Include the NavigationMenu view
require_once $viewsPath . 'partials/NavigationMenu.php';

// Include the views
require_once $viewsPath . 'MainPage.php';
require_once $viewsPath . 'CreateMenu.php';
require_once $viewsPath . 'Orders.php';
require_once $viewsPath . 'Login.php';

// Get the data from the API
$apiHandler = new APIHandler();

// Parse the config.ini file
$config = parse_ini_file('./includes/config.ini');
if ($config === false) {
    echo '<script>alert("Error: config.ini file not found");</script>';
}

// Now you can access the variables from the config.ini file
$apiURL = $config['API_URL'];
if ($apiURL === '') {
    echo '<script>alert("Error: API_URL not found in config.ini");</script>';
}

// Use the $apiURL variable to fetch data from the API
$plats = $apiHandler->fetchFromAPI($apiURL . '/plats');
$menus = $apiHandler->fetchFromAPI($apiURL . '/menus');

// Use a switch-case to load the correct view based on the page
echo match ($page) {
    'home' => (new MainPage)->toString($menus),
    'create-menu' => (new CreateMenu())->toString($plats),
    'orders' => (new Orders)->toString(),
    'login' => (new Login)->toString(),
    default => '404 - Page not found',
};
