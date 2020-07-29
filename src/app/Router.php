<?php

namespace App;


use App\Route;
use App\RouteNotFoundException;
use Closure;

class Router
{
    /**
     * Contains routes of router.
     * 
     * @var array
     */
    public $routes = [];

    /**
     * Adding new route to existing routes.
     * 
     * @param string $pattern Pattern of url
     * @param string $method Method of url
     * @param Closure $callback Callback function for handling request
     * @throws \InvalidArgumentException 
     */
    public function addRoute(string $pattern, string $method, Closure $callback)
    {
        array_push($this->routes, new Route($pattern, $method, $callback));
    }

    public function handle()
    {
        $pattern = $_SERVER['REQUEST_URI'];
        $route = array_map(function(\App\Route $i) use($pattern) {
            if($i->pattern == $pattern) { return $i; };
        }, $this->routes);
        
        if($route == null) {
            throw new RouteNotFoundException;
        }
        


    }

}