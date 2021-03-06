<?php

class Application_Form_Registration extends Zend_Form
{

         public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        //$this->setAction('/Zend/blog/public/post/add-post');
//---------------------------------------------------------------------------------------
        $username=new Zend_Form_Element_Text("username");
        $username->setRequired();
        $username->setLabel("User Name :");
        //$username->addValidator(new Zend_Validate_Alpha());
        $username->setAttrib("placeholder","Enter your username");
        $username->setAttrib("class","form-control");
//--------------------------------------------------------------------------------------
        /// for  input  email 
        $useremail=new Zend_Form_Element_Text("useremail");
        $useremail->setRequired();
        $useremail->setLabel("Email  :");
        $useremail->addValidator(new Zend_Validate_EmailAddress());
        $useremail->addValidator(new Zend_Validate_Db_NoRecordExists(
            array(
              'table' => 'users',
              'field' => 'useremail'
            )
        ));
        $useremail->setAttrib("placeholder","Enter your email");
        $useremail->setAttrib("class","form-control");
//--------------------------------------------------------------------------------
        // for  input password  
        $password=new Zend_Form_Element_Password('password');
        $password->setRequired();
        $password->setLabel("Password :");
        $password->setAttrib("class","form-control");
        $password->setAttrib("placeholder","Enter your password");
        $password->addValidator(new Zend_Validate_StringLength(array('min'=>5,'max'=>15)));
//---------------------------------- Gender --------------------------------------------------
        // for  in put  gender 

        $gender= new Zend_Form_Element_Radio('gender');
        $gender->setRequired();
        $gender->setLabel("Gender :");
        $gender->addMultiOptions( array('Female' => 'Female','Male' => 'Male'));
//---------------------------------- Country --------------------------------------------------
        $country = new Zend_Form_Element_Select('country');
        $country->setLabel('Country :');
        $country->setMultiOptions(array('egypt'=>'Egypt', 'USA'=>'USA'));
        $country->setRequired(true)->addValidator('NotEmpty', true);
        $country->setAttrib("class","form-control"); 
//-----------------------------up load image --------------------------------------------------------------- 
        $picture = new Zend_Form_Element_File('picture');
        $picture->setLabel("Upload Image ");
        $picture->setAttrib("class"," btn btn-info");
        $picture->setRequired(true);  
        $picture->setDestination('../public/images');
        $picture->addValidator('Count', false, 1); 
        //$picture->addValidator('Size', false, 2097152); 
      //  $picture->setMaxFileSize(2097152);            
        $picture->addValidator('Extension', false, 'jpg,jpeg,png,gif');
        $picture->getValidator('Extension')->setMessage('This file type is not supportted.');

//--------------------------------------------------------------------------------------------        
     $captchaElement = new Zend_Form_Element_Captcha('signup',
                    array('captcha' => array(
                    'captcha' => 'Figlet',
                    'wordLen' => 6,
                    'timeout' => 600))
                    );
    $captchaElement->setLabel('Please type in thewords below to continue');  
   
//--------------------------------------------------------------------------------
        // for  input  button submit  
        $submit=new Zend_Form_Element_Submit('submit');  
        $submit->setAttrib("class","form-control  btn btn-info");
//---------------------------------------------------------------------------------------------
        // add componnent  
        $this->setAttrib("class","form-horizontal");
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setMethod("post");
        $this->addElements(array($username,$useremail,$password,$country,$gender,$picture,$captchaElement,$submit));
    }
    
}
