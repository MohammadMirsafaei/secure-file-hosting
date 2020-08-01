<?php

namespace App;
use App\Router;
use Closure;

class App {

    /**
     * Instance of app
     * 
     * @var \App
     */
    private static $instance = null;

    /**
     * Router of app
     * 
     * @var \App\Router
     */
    private $router;

    private function __construct()
    {
        $this->router = new Router();
    }

    /**
     * Inits app instance
     * 
     * @return \App\App
     * @throws \Exception
     */
    public static function init() : App
    {
        if(self::$instance == null)
        {
            self::$instance = new App();
            return self::$instance;
        } else {
            throw new \Exception('An instance of app already exists.');
        }
    }

    /**
     * Gets instance of app
     * 
     * @return \App\App
     * @throws \Exception
     */
    public static function getInstance() : App
    {
        if(self::$instance == null)
        {
            throw new \Exception('There is no instance of app.');
        } else {
            return self::$instance;
        }
    }

    public function handle(string $pattern, string $method, Closure $caallback)
    {
        $this->router->addRoute($pattern, $method, $caallback);
    }

    public function run()
    {
        $this->router->handle();
    }


}