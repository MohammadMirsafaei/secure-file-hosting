<?php

namespace App;


use App\Route;

class Router
{
    /**
     * Contains routes of router.
     * 
     * @var array(Route)
     */
    private $routes = [];

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
        if($pattern == '')
            throw new \InvalidArgumentException('Pattern should be a non empty string');

        if($method == ''
            || !in_array($method,['GET','POST'])) {
                throw new \InvalidArgumentException('Method shold be a non empty string and one of GET,POST');
        }

        array_push($this->routes, new Route($pattern, $method, $callback));
    }

}