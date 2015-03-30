<?php

use Phalcon\Mvc\Controller;


class BaseController extends Controller
{

    public $userModel;

    public function initialize()
    {

        if ($this->getDi()->getRouter()->getControllerName() != 'index'
            && $this->getDi()->getRouter()->getActionName() != 'signin'
            && $this->getDi()->getRouter()->getActionName() != 'signup'
            && $this->getDi()->getRouter()->getActionName() != 'signout'
        ) {
            $auth = $this->session->get('auth');
            $sessionModel = Session::findFirst("session = '$auth'");
            if ($sessionModel) {
                $sessionModel->setSession($this->security->hash($auth))->save();
                $this->getDi()->getSession()->set('auth', $sessionModel->getSession());
                $this->userModel = $sessionModel->getUser();
            }
        }
    }

    /**
     * @param $obj
     */
    protected function setErrorMessages($obj)
    {
        foreach ($obj->getMessages() as $msg) {

            $this->flashSession->error($msg);
        }
    }
}
