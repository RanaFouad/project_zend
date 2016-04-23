<?php

class Application_Form_ChangePassword extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        // --------------- old password  -------------- 
         $oldpassword=new Zend_Form_Element_Password('oldpassword');
        $oldpassword->setRequired();
      //  $oldpassword->setLabel("Confirm Password :");
        $oldpassword->setAttrib("class","form-control");
        $oldpassword->setAttrib("placeholder","Enter Old  Password");
        $oldpassword->addValidator(new Zend_Validate_StringLength(array('min'=>5,'max'=>15)));

        //---------  new  password  ---------------------
         $newpassword=new Zend_Form_Element_Password('password');
        $newpassword->setRequired();
        //$newpassword->setLabel("Confirm Password :");
        $newpassword->setAttrib("class","form-control");
        $newpassword->setAttrib("placeholder","Enter New Password");
        $newpassword->addValidator(new Zend_Validate_StringLength(array('min'=>5,'max'=>15)));

        // ---------------- confirm  new  password  ---------------- 
        $confpassword=new Zend_Form_Element_Password('confpassword');
        $confpassword->setRequired();
       // $confpassword->setLabel("Confirm Password :");
        $confpassword->setAttrib("class","form-control");
        $confpassword->setAttrib("placeholder","Enter your Confirm Password");
        $confpassword->addValidator(new Zend_Validate_StringLength(array('min'=>5,'max'=>15)));

        //------ submit  --------------------- 
            $submit=new Zend_Form_Element_Submit('SavePassword');  
        $submit->setAttrib("class","form-control  btn btn-info");
//---------------------------------------------------------------------------------------------
        // add componnent  
        $this->setAttrib("class","form-horizontal");
       
        $this->setMethod("post");
        $this->addElements(array($oldpassword,$newpassword,$confpassword,$submit));

    }


}

