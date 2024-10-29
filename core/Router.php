<?php
namespace dwes\core;

 use dwes\app\exceptions\NotFoundException;
 
class Router
{
    private $routes;
    /**
     * @param array $routes
     * @return void
     */
    private function __construct()
    {
        $this->routes = [
            'GET' => [],
            'POST' => []
        ];
    }
    /**
     * @param sring $file
     * @return Router
     */
    public static function load(string $file): Router
    {
        $router = new Router();
        require $file;
        return $router;
    }

    public function get(string $uri, string $controller): void
    {
        $this->routes['GET'][$uri] = $controller;
    }
    public function post(string $uri, string $controller): void
    {
        $this->routes['POST'][$uri] = $controller;
    }
    public function direct(string $uri, string $method): string
    {
        if (array_key_exists($uri, $this->routes[$method]))
            return $this->routes[$method][$uri];
        throw new NotFoundException("No se ha definido una ruta para la uri solicitada");
    }
    public function redirect(string $path)
    {
        header('location: /' . $path);
    }
}
