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
    $user = Auth::getAuthUser();
    if($user == null) {
        redirect('/login');
	}
    $username = $request->username;
    $password = $request->password;
    $password_confirm = $request->password_confirm;
    if($password_confirm == $password && User::create($username,$password))
    {
        redirect('/');
    }
    else
	redirect('/add_user');
	
});


//-check integlevel &...
$app->handle('/read_file', 'GET', function(Request $request) use($blade,$static) { 

    $user = Auth::getAuthUser();
    if($user == null) {
        redirect('/login');
	}
    $file_id = $request->id;
    $file = File::getFileById($file_id);
    
    echo $blade->run('read_file',['static'=>$static , 'user'=>$user , 'file'=>$file]);
});






//-check integlevel &...
$app->handle('/edit_file', 'GET', function(Request $request) use($blade,$static) { 

    $user = Auth::getAuthUser();
    if($user == null) {
        redirect('/login');
	}
    $file_id = $request->id;
    $file = File::getFileById($file_id);
    
    echo $blade->run('edit_file',['static'=>$static , 'user'=>$user , 'file'=>$file]);
});
$app->handle('/edit_file', 'POST', function(Request $request) use($blade,$static) {
    $user = Auth::getAuthUser();
    if($user == null) {
        redirect('/login');
	}
    $file_id = $request->file_id;
    $content = $request->content;

    if(File::update($file_id,$content))
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
    $user = Auth::getAuthUser();
    if($user == null) {
        redirect('/login');
	}
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
