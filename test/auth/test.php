<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Auth\Auth;

function Test_test()
{
    $auth = new Auth;
    $auth->test();
}

Test_test();