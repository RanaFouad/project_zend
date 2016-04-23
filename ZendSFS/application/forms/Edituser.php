<?php

class Application_Form_Edituser extends Zend_Form
{

    public function init()
    {
        #################UserName#############################################
	    $username = new Zend_Form_Element_Text("username");
		$username->setRequired();
		$username->addValidator(new Zend_Validate_Alpha());
		$username->setlabel("UserName:");
		$username->setAttrib("class","form-control");
		$username->setAttrib("placeholder","Enter your username");
		#########################Email###############################################
		$email = new Zend_Form_Element_Text("useremail");
		$email->setRequired();
		$email->addValidator(new Zend_Validate_EmailAddress());
		$email->addValidator(new Zend_Validate_Db_NoRecordExists(
		    array(
			  'table' => 'users',
			  'field' => 'useremail'
		    )
		));
		$email->setAttrib("class","form-control");
		$email->setlabel("Email:");
		$email->setAttrib("placeholder","Enter your Email");
		#########################Password############################################
		$password = new Zend_Form_Element_Password("password");
		$password->setRequired();
		$password->setlabel("Password:(your password must be not less than 5 character and not more 10)");
		$password->addValidator(new Zend_Validate_StringLength(array('min' => 5, 'max' => 10)));
		$password->setAttrib("placeholder","Enter your Password");
		$password->setAttrib("class","form-control");
		############################Picture#######################################
		
		##########################Signature#######################################
        $signatuer = new Zend_Form_Element_Text("signatuer");
		$signatuer->setRequired();
		
		$signatuer->addValidator(new Zend_Validate_Db_NoRecordExists(
		    array(
			  'table' => 'users',
			  'field' => 'signatuer'
		    )
		));
		$signatuer->setlabel("Signature:");
		$signatuer->setAttrib("placeholder","Enter your Signature");
		$signatuer->setAttrib("class","form-control");
		###################################	Gender#################################
		$gender = new Zend_Form_Element_Select('gender');
        $gender->setLabel('Gender:')
              ->setMultiOptions(array('Male'=>'Male', 'Famale'=>'Famale'))
              ->setRequired(true)->addValidator('NotEmpty', true)
              ->setAttrib("class","form-control");

		####################################country###############################	
		$country = new Zend_Form_Element_Text("country");
		$country->setRequired();
		$country->addValidator(new Zend_Validate_Alpha());
		$country->setlabel("Country:");
		$country->setAttrib("class","form-control");
		$country->setAttrib("placeholder","Enter your country");	
		#####################################Submit###############################
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib("class","btn btn-primary");
		###################3Add Elements To form############################

	    $this->addElements(array($username, $email, $password, $picture,
	    	    $signatuer,$gender,$country,$submit));
    										

    }

}

