<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $registration= new Application_Form_Registration();

        $this->view->registration=$registration;

    }

}

