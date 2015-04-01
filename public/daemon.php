<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/handlers/Chat.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

$chatObj = new Chat();

$server = IoServer::factory(new HttpServer(new WsServer($chatObj)), 8080);

$server->run();
