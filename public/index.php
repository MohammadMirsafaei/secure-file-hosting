<?php
session_start();
require_once __DIR__.'/../vendor/autoload.php';

use App\App;
use App\Request;
use App\BadMethodException;
use App\RouteNotFoundException;
use Auth\Auth;
use eftec\bladeone\BladeOne;
use Database\Database;
use Models\User;

$app = App::init();
$blade = new BladeOne(__DIR__.'/views',__DIR__.'/../cache',BladeOne::MODE_DEBUG);
$static = '/assets';



$app->handle('/login', 'GET', function() use($blade,$static) { 
    if(Auth::getAuthUser() != null) {
        redirect('/');
    }
    echo $blade->run('login',['static'=>$static]);
});
$app->handle('/login', 'POST', function(Request $request) use($blade,$static) {
    $username = $request->username;
    $password = $request->password;
    if(Auth::authenticate($username,$password))
    {
        redirect('/');
    }
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



function redirect(string $path)
{
    header("Location:".$path);
}