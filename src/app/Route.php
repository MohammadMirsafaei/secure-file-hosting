<?php

namespace App;

class Route
{
    private $pattern;
    private $method;
    private $callback;

    public function __construct(string $pattern, string $method, callable $callback)
    {
        if($pattern == '')
            throw new \InvalidArgumentException('Pattern should be a non empty string');

        if($method == ''
            || !in_array($method,['GET','POST'])) {
                throw new \InvalidArgumentException('Method shold be a non empty string and one of GET,POST');
        }

        $this->$pattern = $pattern;
        $this->$method = $method;
        $this->$callback = $callback;
    }
}