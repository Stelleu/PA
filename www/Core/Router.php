<?php

namespace App\Core;

class Router extends RouteVerificator
{
    private $routes;

    public function __construct()
    {
        $this->routes = yaml_parse_file("routes.yml");
    }

    public function routeRequest(): void
    {
        $headers = getallheaders();

        // Vérifier si l'en-tête Content-Type existe
        $contentType = $headers['Content-Type'] ?? '';

        $requestData = [];
        if ($contentType === 'application/json') {
            $requestData = json_decode(file_get_contents('php://input'), true);
        }

        $uriExploded = explode("?", $_SERVER["REQUEST_URI"]);
        $uri = rtrim(strtolower(trim($uriExploded[0])), "/");
        $uri = (empty($uri)) ? "/" : $uri;

        $matchedRoute = null;
        $matchedParams = [];
        foreach ($this->routes as $route => $config) {
            if (strpos($route, '{slug}') !== false) {
                // Pour les routes avec des slugs ...
            } else {
                if ($uri === $route) {
                    $matchedRoute = $route;
                    break;
                }
            }
        }

        if (!empty($requestData)) {
            $this->handleJsonRequest($matchedRoute, $matchedParams, $requestData);
            return;
        }

        if (empty($matchedRoute)) {
            $error = new Error();
            $error->errorRedirection(404);
        }

        $route = $this->routes[$matchedRoute];

        $controller = "\\App\\Controllers\\" . $route["controller"];
        $action = $route["action"];

        // Gérer les autres routes du routeur normalement
        $security = $route["security"];
        $role = $route["role"];

        if (!class_exists($controller)) {
            throw new \Exception("La class " . $controller . " n'existe pas", 500);
        }

        $controllerInstance = new $controller();

        if (isset($security) && $security === true && !self::checkConnexion()) {
            //REDIRECTION LOGIN
            $error = new Error();
            $error->errorRedirection(404);
        }
//        if (isset($role) && !self::checkWhoIAm($role)) {
//            $error = new Error();
//            $error->errorRedirection(404);
//        }

        if (!method_exists($controllerInstance, $action)) {

            throw new \Exception("L'action " . $action . " n'existe pas", 500);

        }
        $controllerInstance->$action(...$matchedParams);
    }

    private function handleJsonRequest($matchedRoute, $matchedParams, $requestData): void
    {
        if (empty($matchedRoute)) {
            $this->sendJsonError("Route non trouvée", 404);
            return;
        }

        $route = $this->routes[$matchedRoute];
        $controller = "\\App\\Controllers\\" . $route["controller"];
        $action = $route["action"];

        $controllerInstance = new $controller();
        if (method_exists($controllerInstance, $action)) {
            $controllerInstance->$action($requestData); // Transmettez les données JSON au contrôleur
        } else {
            $this->sendJsonError("L'action $action n'existe pas", 500);
        }

        $response = array("success" => true, "message" => "Opération réussie");
        $this->sendJsonResponse($response);

    }

    private function sendJsonError($message, $statusCode = 500): void
    {
        http_response_code($statusCode);
        $response = array("success" => false, "error" => $message);
        $this->sendJsonResponse($response);
    }

    private function sendJsonResponse($data): void
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}

