<?php

use Phalcon\Mvc\User\Plugin;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl;

class SecurityPlugin extends Plugin
{
    public function beforeDispatch(Event $event, Dispatcher $dispatcher)
    {
        $controller = $dispatcher->getControllerName();
        if ($controller == 'index' && $this->session->has('auth')) {
            $this->response->redirect('/dashboard')->send();
        }
    }

}