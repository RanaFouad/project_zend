<?php

class Application_Form_LoginUser extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setAttrib("class","form-horizontal");

        $useremail = new Zend_Form_Element_Text('useremail');
        $useremail->setLabel("User Email :");
    	$useremail->setRequired();
    	$useremail->addValidator(new Zend_Validate_EmailAddress());
    	$useremail->setAttrib("placeholder","Enter your email");
        $useremail->setAttrib("class","form-control");

    	$password = new Zend_Form_Element_Password('password');
    	$password->setRequired();
        $password->setLabel("Password :");
        $password->setAttrib("class","form-control");
    	$password->addValidator(new Zend_Validate_StringLength(array('min' => 8,'max'=> 50)));
    	

    	$login = new Zend_Form_Element_Submit('login');
        $login->setAttrib("class","form-control  btn btn-info");

    	$this->addElements(array($useremail,$password,$login));  


    }


}

