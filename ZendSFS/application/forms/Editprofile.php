<?php

class Application_Form_Editprofile extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */

        $userId = new Zend_Form_Element_Hidden('user_id');
//         //-----------------------change user name ----------------------------------------------------------------
        $username=new Zend_Form_Element_Text("username");
        $username->setRequired();
        $username->setLabel("User Name :");
        // $username->addValidator(new Zend_Validate_Alpha());
        $username->setAttrib("placeholder","Enter your username");
        $username->setAttrib("class","form-control");

//         //-----------------------------change password ----------------------------------------------

//                 // for  input password  
        $password=new Zend_Form_Element_Password('password');
        $password->setRequired();
        $password->setLabel("Password :");
        $password->setAttrib("class","form-control");
        $password->setAttrib("placeholder","Enter your Password");
        $password->addValidator(new Zend_Validate_StringLength(array('min'=>5,'max'=>15)));



//   /*      $confpassword=new Zend_Form_Element_Password('confpassword');
//         $confpassword->setRequired();
//         $confpassword->setLabel("Confirm Password :");
//         $confpassword->setAttrib("class","form-control");
//         $confpassword->setAttrib("placeholder","Enter your Confirm Password");
//         $confpassword->addValidator(new Zend_Validate_StringLength(array('min'=>5,'max'=>15)));
// */
//         //---------------------------------- Gender --------------------------------------------------
//         // for  in put  gender 

        $gender= new Zend_Form_Element_Radio('gender');
        $gender->setRequired();
        $gender->setLabel("Gender :");
        $gender->addMultiOptions( array('Female' => 'Female','Male' => 'Male'));
// 		//---------------------------------- Country --------------------------------------------------
        $country = new Zend_Form_Element_Select('country');
        $country->setLabel('Country :');
        $country->setMultiOptions(array('egypt'=>'Egypt', 'USA'=>'USA'));
        $country->setRequired(true)->addValidator('NotEmpty', true);
        $country->setAttrib("class","form-control"); 
// 		//-----------------------------up load image --------------------------------------------------------------- 
        $picture = new Zend_Form_Element_File('picture');
        $picture->setLabel("Upload Image ");
        $picture->setAttrib("class"," btn btn-info");
        $picture->setRequired(true);  
        $picture->setDestination(APPLICATION_PATH.'/../public/images');
        $picture->addValidator('Count', false, 1); 
        $picture->addValidator('Size', false, 2097152); 
      	$picture->setMaxFileSize(2097152);            
        $picture->addValidator('Extension', false, 'jpg,jpeg,png,gif');
        $picture->getValidator('Extension')->setMessage('This file type is not supportted.');

        $submit=new Zend_Form_Element_Submit('save');  
        $submit->setAttrib("class","form-control  btn btn-info");
// //---------------------------------------------------------------------------------------------
//         // add componnent  
        $this->setAttrib("class","form-horizontal");

        $this->setAttrib('enctype', 'multipart/form-data');

        $this->setMethod("post");

        $this->addElements(array($userId,$username,$password,$country,$gender,$picture,$submit));
    
    }


}

