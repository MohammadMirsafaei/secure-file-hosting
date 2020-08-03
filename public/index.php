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
use Models\File;

$app = App::init();
$blade = new BladeOne(__DIR__.'/views',__DIR__.'/../cache',BladeOne::MODE_DEBUG);
$static = '/assets';


//Done
$app->handle('/', 'GET', function() use($blade,$static) { 
    $user = Auth::getAuthUser();
    if($user == null) {
        redirect('/login');
	}
    $files = File::all();
    echo $blade->run('list',['static'=>$static , 'user'=>$user, 'files'=>$files]);
});



//-lables
$app->handle('/add_user', 'GET', function() use($blade,$static) { 
    $user = Auth::getAuthUser();
    if($user == null) {
        redirect('/login');
	}
    echo $blade->run('add_user',['static'=>$static , 'user'=>$user]);
});
$app->handle('/add_user', 'POST', function(Request $request) use($blade,$static) {
    $username = $request->username;
    $password = $request->password;
    if(User::create($username,$password))
    {
        redirect('/');
    }
});


//----------------------
$app->handle('/change_password', 'GET', function() use($blade,$static) { 
    $user = Auth::getAuthUser();
    if($user == null) {
        redirect('/login');
	}
    echo $blade->run('change_password',['static'=>$static , 'user'=>$user]);
});
$app->handle('/change_password', 'POST', function(Request $request) use($blade,$static) {
    $username = $request->username;
    $password = $request->password;
    if(User::create($username,$password))
    {
        redirect('/');
    }
});



//-check integritylevel & ...
$app->handle('/add_file', 'GET', function() use($blade,$static) { 
    $user = Auth::getAuthUser();
    if($user == null) {
        redirect('/login');
	}
    echo $blade->run('add_file',['static'=>$static , 'user'=>$user]);
});
$app->handle('/add_file', 'POST', function(Request $request) use($blade,$static) {

    $name = $request->name;
    $content = $request->content;
    $confLevel = $request->confidentialitylevel;
    $integLevel = $request->integritylevel;
    $user =  Auth::getAuthUser()->username;

    if(File::create($name,$content,$confLevel,$integLevel,$user))
    {

        redirect('/');
    }
});



//Done
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
$app->handle('/logout', 'GET', function(Request $request) {    
    Auth::revoke();
    redirect('/login');
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
