<?php

return new \Phalcon\Config(array(
    'database' => array(
        'adapter' => 'Mysql',
        'host' => 'chat.dev',
        'username' => 'root',
        'password' => '',
        'dbname' => 'chat',
        'charset' => 'utf8',
    ),
    'application' => array(
        'controllersDir' => __DIR__ . '/../../app/controllers/',
        'modelsDir' => __DIR__ . '/../../app/models/',
        'viewsDir' => __DIR__ . '/../../app/views/',
        'formsDir' => __DIR__ . '/../../app/forms/',
        'handlersDir' => __DIR__ . '/../../app/handlers/',
        'pluginsDir' => __DIR__ . '/../../app/plugins/',
        'libraryDir' => __DIR__ . '/../../app/library/',
        'vendorDir' => __DIR__ . '/../../vendor/',
        'cacheDir' => __DIR__ . '/../../app/cache/',
        'baseUri' => '',
    ),
));
