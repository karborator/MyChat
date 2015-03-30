<?php

use Phalcon\Mvc\Router;

$router = new Router();

$router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);
$router->removeExtraSlashes(true);


$router->add('/authenticate/sign-in', array(
    'controller' => 'authenticate',
    'action' => 'signin'
));

$router->add('/authenticate/sign-up', array(
    'controller' => 'authenticate',
    'action' => 'signup'
));

$router->add('/authenticate/sign-out', array(
    'controller' => 'authenticate',
    'action' => 'signout'
));

$router->add('/ajax/history', array(
    'controller' => 'ajax',
    'action' => 'history'
));

$router->add('/ajax/send', array(
    'controller' => 'ajax',
    'action' => 'send'
));

$router->add('/ajax/update', array(
    'controller' => 'ajax',
    'action' => 'update'
));

return $router;