<?php

// Récupérer l'URL demandée
$requestUrl = $_SERVER['REQUEST_URI'];
// echo $requestUrl;


// Obtenir le chemin de l'URL sans les paramètres de requête
$parsedUrl = parse_url($requestUrl);
$path = $parsedUrl['path'];

// Diviser le chemin en segments
$segments = explode('/', $path);

// $dossier = str_replace('/folders', '/files', $requestUrl);
$requestUrl = str_replace(BASE_URL, '', $requestUrl);

// Utiliser la fonction parse_url pour extraire le chemin de l'URL
$path = parse_url($requestUrl, PHP_URL_PATH);

$segments = explode('/', $path);

// Utiliser la fonction count pour obtenir le nombre de segments
$numberOfSegments = count($segments);
define('NB_LEVEL', $numberOfSegments);



// Définir les routes et les actions correspondantes
$routes = [
    '' => 'HomeController@form',
    '/' => 'HomeController@form',
    '/enregistrements' => 'HomeController@data',
    '/enregistrements/' => 'HomeController@data',
    '/register' => 'HomeController@inscription',
    '/register/' => 'HomeController@inscription',
    '/logout' => 'HomeController@logout',

    '/{params}' => 'HomeController@form',
    '/{params}/' => 'HomeController@form',

];

// Chercher une correspondance entre l'URL demandée et les routes définies
$routeFound = false;
foreach ($routes as $route => $action) {
    // Remplacer les parties variables de l'URL par des groupes de capture
    $pattern = '#^' . preg_replace('/\\\{([a-zA-Z0-9_]+)\\\}/', '([^/]+)', preg_quote($route, '#')) . '$#';

    // Utiliser une expression régulière pour vérifier la correspondance de l'URL
    if (preg_match($pattern, $requestUrl, $matches)) {
        $routeFound = true;
        break;
    }
}

// Traiter la route correspondante
if ($routeFound) {
    // Extraire le nom du contrôleur et de la méthode d'action
    [$controllerName, $methodName] = explode('@', $action);
    require_once 'app/controllers/' . $controllerName . '.php';
    // Inclure le fichier du contrôleur correspondant

    // Instancier le contrôleur
    $controller = new $controllerName();

    // Retirer le premier élément de $matches qui correspond à l'URL complète
    array_shift($matches);

    // Appeler la méthode d'action correspondante en passant les segments variables
    $controller->$methodName(...$matches);
} else {
    // Aucune correspondance de route trouvée, afficher une page d'erreur 404
    http_response_code(404);
    echo 'Page not found';
    // Vous pouvez également rediriger vers une page d'erreur personnalisée :
    // header('Location: /error-404');
    // exit;
}
