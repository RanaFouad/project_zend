<?php

class UsercategoryController extends Zend_Controller_Action
{

    private $model;
    private $model_sub_category;
    private $model_thread;

    public function init()
    {
        /* Initialize action controller here */
        $this->model = new Application_Model_DbTable_Usercategory();
        $this->model_sub_category = new Application_Model_DbTable_SubCategory();
        $this->model_thread = new Application_Model_DbTable_Thread();
    }

    public function indexAction()
    {
        $category=$this->model->listCategory();
        $sub_category = $this->model_sub_category->list_all_sub_category();
        $thread = $this->model_thread->list_all_thread();
        //var_dump($category);
        $this->view->category = $category;
        $this->view->sub_category = $sub_category;
        $this->view->thread = $thread;
    }

    public function listcategoryAction()
    {
        
    	$data = $this->getRequest()->getParam('user_id');
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        if ($user->user_id == $data)
        {
        	$category=$this->model->listCategory();
            $sub_category = $this->model_sub_category->list_all_sub_category();
            $thread = $this->model_thread->list_all_thread();
            //var_dump($category);
            $this->view->category = $category;
            $this->view->sub_category = $sub_category;
            $this->view->thread = $thread;
        }
        else
        {
            $this->redirect('/Users/logout');

        }	


    }

    public function addcategoryAction()
    {
        $data = $this->getRequest()->getParams();
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        if($user->user_id == $data['user_id'])
        {
        	if($user->admin == 1)
        	{	
        		$form = new Application_Form_Category();
        		if($this->getRequest()->isPost())
            	{   
                	if($form->isValid($data))
                	{    
                    	if($this->model->addCategory($data))
                    	{
                        	$this->redirect('Usercategory/listcategory/user_id/'.$user->user_id);
                    	}
                	}	    
        
            	}
            	$this->view->form = $form;
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

    public function deletecategoryAction()
    {
        $cat_id = $this->getRequest()->getParam('cat_id');
        $userdata=new Zend_Session_Namespace( 'userdata' );
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        if($cat_id)
        {
        	if ($user->user_id == $userdata->id && $user->admin == 1)
        	{
				if($this->model->deleteCategory($cat_id))
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

    public function editcategoryAction()
    {
        $cat_id = $this->getRequest()->getParam('cat_id');
        $userdata=new Zend_Session_Namespace( 'userdata' );
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        if($cat_id)
        {
        	if ($user->user_id == $userdata->id && $user->admin == 1)
        	{
        		$form = new Application_Form_Category();
            	$category = $this->model->getCategoryById($cat_id);
            	$form->populate($category[0]);
                $this->view->form = $form;
                if($this->getRequest()->isPost())
                {
                	$data = $this->getRequest()->getParams();
                	if($form->isValid($data))
                    {    
                        if($this->model->editCategory($cat_id, $data))
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

    public function categorydetailsAction()
    {
        $data = $this->getRequest()->getParam('cat_id');
        $category = $this->model->getCategoryById($data);
        $this->view->cat=$category;
        $sub_category = $this->model_sub_category->list_sub_category($data);
        $this->view->sub_category = $sub_category;
    }


}













