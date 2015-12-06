<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;


$loader =  require __DIR__.'/../app/autoload.php';
Debug::enable();


$apcLoader = new Symfony\Component\ClassLoader\ApcClassLoader(sha1(__FILE__), $loader);
$loader->unregister();
$apcLoader->register(true);

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
