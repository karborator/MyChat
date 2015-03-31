<?php

class DashboardController extends BaseController
{

    public function indexAction()
    {
        $username = $this->userModel->getUsername();
        $this->view->setVar('userModel', User::find("username != '$username'"));
        $this->view->setVar('username', $username);
    }

}

