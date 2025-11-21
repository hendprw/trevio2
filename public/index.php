<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../routes.php';

$database = new Database();
$db = $database->getConnection();

// Simple Router Dispatcher
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (array_key_exists($uri, $routes)) {
    $route = $routes[$uri];
    $controllerName = $route[0];
    $action = $route[1];
    
    require_once __DIR__ . "/../controllers/$controllerName.php";
    $controller = new $controllerName($db);
    
    // Pass ID if present in query string for GET actions like /hotel?id=1
    if(isset($_GET['id'])) {
        $controller->$action($_GET['id']);
    } else {
        $controller->$action();
    }
} else {
    // Simple Dynamic Route handling for clean URLs could be regex, 
    // but keeping it simple for native: use Query params ?id=1
    echo "404 Not Found";
}
?>