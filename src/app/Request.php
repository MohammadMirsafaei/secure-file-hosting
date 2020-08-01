<?php

namespace App;

class Request {

    private $props = [];
    private $method = null;
    
    public function __construct(string $method)
    {
        if(!in_array($method,['GET','POST'])) {
            throw new \InvalidArgumentException("method should be GET or POST.");
        }
        $this->method = $method;
        
        //$props = ${'_' . $this->method};

        if($this->method == 'GET')
            $this->props = $_GET;
        else
            $this->props = $_POST;
        

    }

    public function __set($name, $value)
    {
        
    }

    public function __get($name)
    {
        
        if(array_key_exists($name,$this->props)) {
            return $this->props[$name];
        } else {
            throw new \UnexpectedValueException("property is not present in list.");
        }
    }






}