<?php

class IndexController extends BaseController
{

    public function indexAction()
    {
        $signInForm = new SignInForm();
        $signUpForm = new SignUpForm();

        $this->view->setVar("signInForm", $signInForm);
        $this->view->setVar("signUpForm", $signUpForm);
    }
}

