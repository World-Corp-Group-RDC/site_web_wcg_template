<?php

namespace App;

class Router
{
    /**
     * @var string
     */
    private $viewPath; // contiendra le chemin du nos view

    /**
     * @var  AltoRouter
     */
    private $router;

    private $url; // Contiendra l'URL sur laquelle on souhaite se rendre
    private $routes = []; // Contiendra la liste des routes

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function get($path, $callable)
    {
        $route = new Route($path, $callable);
        $this->routes["GET"][] = $route;
        return $route; // On retourne la route pour "enchainer" les méthodes
    }
    public function post($path, $callable)
    {
        $route = new Route($path, $callable);
        $this->routes["POST"][] = $route;
        return $route; // On retourne la route pour "enchainer" les méthodes
    }

    public function run()
    {
        // echo '<pre>';
        // echo print_r($this->routes);
        // echo '<pre>';
        if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            //  throw new \Exception ('REQUEST_METHOD does not exist');
            throw new RouterException('REQUEST_METHOD does not exist');
        }
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->url)) {
                return $route->call();
            }
        }
        // throw new \Exception ('No matching routes');
        throw new RouterException('No matching routes');
    }
}
