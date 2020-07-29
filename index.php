<?php

require_once __DIR__.'/vendor/autoload.php';

use App\App;
use App\RouteNotFoundException;

$app = App::init();
$app->handle('/', 'GET', function() {
    
});
$app->handle('/get', 'GET', function() {

});


try {
    $app->run();
} catch (RouteNotFoundException $e) {
    http_response_code(404);
    echo 'Path not found';
} catch(Exception $e) {

}


