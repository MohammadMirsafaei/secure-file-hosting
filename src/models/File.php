<?php

namespace Models;

class File {
    public $id;
    public $name;
    public $content;

    public function __construct(string $name, string $content)
    {
        $this->name = $name;
        $this->content = $content;
    }

    
}