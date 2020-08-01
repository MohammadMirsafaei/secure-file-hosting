<?php

require_once __DIR__.'/vendor/autoload.php';

use App\App;
use App\BadMethodException;
use App\RouteNotFoundException;

$app = App::init();

$app->handle('/', 'GET', function() {
    echo "hi";
});


try {
    $app->run();
} catch (RouteNotFoundException $e) {
    http_response_code(404);
    echo 'Path not found';
} catch(BadMethodException $e) {
    http_response_code(404);
    echo 'Bad method';
} catch(Exception $e) {

}


