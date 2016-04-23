<?php

class Application_Form_Thread extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */

        $thread_id = new Zend_Form_Element_Hidden('thread_id');


    	$thread_title = new Zend_Form_Element_Text('thread_title');
    	$thread_title->setRequired();
    	$thread_title->setlabel("Thread Title : ");
    	$thread_title->setAttrib("placeholder","Enter your thread title");
    	$thread_title->setAttrib("class","form-control");

    	$thread_body = new Zend_Form_Element_Textarea('thread_body');
        $thread_body->setAttribs(array('cols' => 15,'rows' => 5));
    	$thread_body->setRequired();
    	$thread_body->setlabel("Thread Body : ");
 	  	$thread_body->setAttrib("placeholder","Enter your thread Body");
 	  	$thread_body->setAttrib("class","form-control");

    	$submit = new Zend_Form_Element_Submit('Add');
    	$submit->setAttrib("class","form-control  btn btn-info pull-right");

    	$this->addElements(array($thread_id,$thread_title,$thread_body,$submit));
    }


}

