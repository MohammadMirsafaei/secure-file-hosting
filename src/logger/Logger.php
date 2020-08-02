<?php

namespace Logger;

use Models\Log;

class Logger {
    
    public static function log(string $content)
    {
        Log::create($content);        
    }

    public static function all(): array
    {
        return Log::all();
    }
}