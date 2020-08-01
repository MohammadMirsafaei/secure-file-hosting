<?php

namespace App;


use App\Route;
use App\Request;
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
     * @param callable $callback Callback function for handling request
     * @throws \InvalidArgumentException 
     */
    public function addRoute(string $pattern, string $method, callable $callback)
    {
        array_push($this->routes, new Route($pattern, $method, $callback));
    }

    public function handle()
    {
        $pattern = strtok($_SERVER["REQUEST_URI"], '?');
        $route = array_filter(
            $this->routes,
            function(\App\Route $i) use($pattern) {
                return $i->pattern == $pattern;
            }
        );

        
        
        
        
        if($route == null) {
            throw new RouteNotFoundException;
        }
        
        $route = array_values(array_filter(
            $route,
            function(\App\Route $i) {
                return $i->method == $_SERVER['REQUEST_METHOD'];
            }
        ))[0];
            

        if($route == null) {
            throw new BadMethodException;
        }

        $route->callback->__invoke(new Request($route->method));
        


    }

}