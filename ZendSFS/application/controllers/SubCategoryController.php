<?php

class SubCategoryController extends Zend_Controller_Action
{

    private $model = null;

    public function init()
    {
        /* Initialize action controller here */
        $this->model = new Application_Model_DbTable_SubCategory();
    }

    public function indexAction()
    {
        // action body
    }

    public function addfourmAction()
    {
        $data = $this->getRequest()->getParams();
        $form = new Application_Form_Subcategory();
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        if($user->admin == 1)
        {	
        	$data['sub_cat_user_id']=$user->user_id;
        	if($this->getRequest()->isPost())
        	{
        		if($form->isValid($data))
        		{
        			if($this->model->addFourm($data))
                	{
                    	$this->redirect('Usercategory/listcategory/user_id/'.$user->user_id);
                	}
        		}

        	}	

        	$this->view->form = $form;

    	}
    	else
    	{
    		$this->redirect('/users/logout');
    	}	
    }

    public function deletesubcategoryAction()
    {
        $sub_cat_id = $this->getRequest()->getParam('sub_cat_id');
        $userdata=new Zend_Session_Namespace( 'userdata' );
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        if($sub_cat_id)
        {
        	if ($user->user_id == $userdata->id && $user->admin == 1)
        	{
        		if($this->model->deletesubCategory($sub_cat_id))
				{
					$this->redirect('Usercategory/listcategory/user_id/'.$user->user_id);	
				}
				else
				{
					$this->redirect('Usercategory/listcategory/user_id/'.$user->user_id);

				}

        	}
        	else
        	{
            	$this->redirect('/users/logout');
        	}	

        }
        else
        {
            $this->redirect('/users/logout');

        }


    }

    public function editsubcategoryAction()
    {
        $sub_cat_id = $this->getRequest()->getParam('sub_cat_id');
        $userdata=new Zend_Session_Namespace( 'userdata' );
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        if($sub_cat_id)
        {
        	if ($user->user_id == $userdata->id && $user->admin == 1)
        	{
        		$form = new Application_Form_Subcategory();
        		$sub_category = $this->model->getSubCategoryById($sub_cat_id);
            	$form->populate($sub_category[0]);
                $this->view->form = $form;
                if($this->getRequest()->isPost())
                {
                	$data = $this->getRequest()->getParams();
                	if($form->isValid($data))
                    {    
                        if($this->model->editSubCategory($sub_cat_id, $data))
                        {
                            $this->redirect('Usercategory/listcategory/user_id/'.$user->user_id);
                        }
                    } 
                }

        	}
        	else
        	{
            	$this->redirect('/users/logout');
        	}

        }
        else
        {
            $this->redirect('/users/logout');

        }

    }

    public function banthreadAction()
    {
        $sub_cat_id = $this->getRequest()->getParam('sub_cat_id');
        $userdata=new Zend_Session_Namespace( 'userdata' );
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        if($sub_cat_id)
        {
        	if ($user->user_id == $userdata->id && $user->admin == 1)
        	{
        		$data['ban_thread']=1;
        		if($this->model->banthread($sub_cat_id, $data))
                {
                    $this->redirect('Usercategory/listcategory/user_id/'.$user->user_id);
                }

        	}
        	else
        	{
            	$this->redirect('/users/logout');

        	}

        }
        else
        {
            $this->redirect('/users/logout');

        }	

    }

    public function releasebanthreadAction()
    {
		$sub_cat_id = $this->getRequest()->getParam('sub_cat_id');
        $userdata=new Zend_Session_Namespace( 'userdata' );
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        if($sub_cat_id)
        {
        	if ($user->user_id == $userdata->id && $user->admin == 1)
        	{
        		$data['ban_thread']=0;
        		if($this->model->banthread($sub_cat_id, $data))
                {
                    $this->redirect('Usercategory/listcategory/user_id/'.$user->user_id);
                }

        	}
        	else
        	{
            	$this->redirect('/users/logout');

        	}

        }
        else
        {
            $this->redirect('/users/logout');

        }        
    }


}











