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
        $uriExploded = explode("?", $_SERVER["REQUEST_URI"]);
        $uri = rtrim(strtolower(trim($uriExploded[0])), "/");
        $uri = (empty($uri)) ? "/" : $uri;

        $matchedRoute = null;
        $matchedParams = [];
        foreach ($this->routes as $route => $config) {
            if (strpos($route, '{slug}') !== false) {
                    // Si la route contient "{slug}", il s'agit d'une route avec un slug
                    $pattern = str_replace('{slug}', '([^/]+)', $route);
                    $regex = '#^' . $pattern . '$#';
                    if (preg_match($regex, $uri, $matches)) {
                        $matchedRoute = $route;
                        if (RouteVerificator::checkSlug($matchedRoute)) {
                            echo $route;

                        // Récupérer les valeurs des paramètres
                        for ($i = 1; $i < count($matches); $i++) {
                            $matchedParams[] = $matches[$i];
                        }
                        break;
                    }
                }
            } else {
                if ($uri === $route) {
                    $matchedRoute = $route;
                    break;
                }
            }
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

//        if (isset($security) && $security === true && !self::checkConnexion()) {
//            //REDIRECTION LOGIN
//            $error = new Error();
//            $error->errorRedirection(404);
//        }
//        if (isset($role) && !self::checkWhoIAm($role)) {
//            $error = new Error();
//            $error->errorRedirection(404);
//        }

        if (!method_exists($controllerInstance, $action)) {

            throw new \Exception("L'action " . $action . " n'existe pas", 500);

        }
        $controllerInstance->$action(...$matchedParams);
    }



}