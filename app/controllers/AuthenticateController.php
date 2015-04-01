<?php

class AuthenticateController extends BaseController
{

    public function signOutAction()
    {
        $this->session->remove("auth");
        $this->session->destroy();
        return $this->response->redirect('/index');
    }

    public function signInAction()
    {
        if ($this->request->isPost()) {
            if ($this->request->getPost('email') && $this->request->getPost('password')) {
                $userModel = new User();
                if ($userModel->auth($this->request->getPost('email', "email"), $this->request->getPost('password', 'string'))) {
                    return $this->response->redirect('/dashboard');
                }
            } else {
                $this->flashSession->error('Email and password are required!');
            }
        }
        return $this->response->redirect('/index');
    }

    public function signUpAction()
    {
        if ($this->request->isPost() && empty($this->session->has('auth'))) {
            $userModel = new User();
            $form = new SignUpForm();
            if ($userModel->save($this->request->getPost(), $form)) {
                $userModel->setSession($userModel);
                return $this->response->redirect('/dashboard');
            }
            $this->setErrorMessages($userModel);
        }
        return $this->response->redirect('/index');
    }
}

