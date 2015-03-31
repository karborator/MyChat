<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;

class SignUpForm extends Form
{
    public function initialize()
    {

        $this->add(new Text("username", array("class" => 'form-control')));

        $this->add(new Text("email", array("class" => 'form-control')));

        $this->add(new Password("password", array("class" => 'form-control')));
    }

}