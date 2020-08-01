<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\App;
use App\Request;
use App\BadMethodException;
use App\RouteNotFoundException;
use eftec\bladeone\BladeOne;

$app = App::init();
$blade = new BladeOne(__DIR__.'/views',__DIR__.'/../cache',BladeOne::MODE_DEBUG);
$static = '/assets';



$app->handle('/login', 'GET', function(Request $request) use($blade,$static) { 
    echo $blade->run('login',['static'=>$static,'name'=>$request->a]);
});
$app->handle('/login', 'POST', function() use($blade,$static) {
    echo 'as';
});





try {
    $app->run();
} catch (RouteNotFoundException $e) {
    http_response_code(404);
    echo 'Path not found';
} catch(BadMethodException $e) {
    http_response_code(405);
    echo 'Bad method';
} catch(Exception $e) {

}


