<?php
// Get the page from the query string
use views\CreateMenuView;
use views\LoginView;
use views\CreateOrderView;

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
require_once $viewsPath . 'MainPageView.php';
require_once $viewsPath . 'CreateMenuView.php';
require_once $viewsPath . 'CreateOrderView.php';
require_once $viewsPath . 'LoginView.php';

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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    (new CreateMenuView)->submitMenu($apiURL, $plats);
}

// Use a switch-case to load the correct view based on the page
echo match ($page) {
    'home' => (new MainPageView)->toString($menus),
    'create-menu' => (new CreateMenuView())->toString($plats),
    'orders' => (new CreateOrderView)->toString($menus),
    'login' => (new LoginView)->toString(),
    default => '404 - Page not found',
};
