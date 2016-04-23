<?php

class Application_Form_Subcategory extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $sub_cat_id = new Zend_Form_Element_Hidden('sub_cat_id');


    	$sub_cat_title = new Zend_Form_Element_Text('sub_cat_title');
    	$sub_cat_title->setRequired();
    	$sub_cat_title->setLabel("Fourm Title :");
    	$sub_cat_title->setAttrib("placeholder","Enter your fourm title");
        $sub_cat_title->setAttrib("class","form-control");


    	$submit = new Zend_Form_Element_Submit('Add');
        $submit->setAttrib("class"," btn btn-info pull-right");
    
        


    	$this->addElements(array($sub_cat_id,$sub_cat_title,$submit));
    }


}

