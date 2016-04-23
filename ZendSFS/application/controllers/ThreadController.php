<?php

class ThreadController extends Zend_Controller_Action
{

    private $model = null;

    private $model_sub_category = null;

    public function init()
    {
        /* Initialize action controller here */
        $this->model = new Application_Model_DbTable_Thread();
        $this->model_sub_category = new Application_Model_DbTable_SubCategory();
    }

    public function indexAction()
    {
        $data = $this->getRequest()->getParam('thread_id');
        //var_dump($data);
        $thread = $this->model->getThreadById($data);
        //var_dump($post);
        $this->view->thread=$thread;
        //$comment = $this->modelcomment->listComments($data);
        //var_dump($comment);
        //$this->view->comments = $this->modelcomment->listComments($data);
    }

    public function addthreadAction()
    {
        $data = $this->getRequest()->getParams();
        $sub_category = $this->model_sub_category->getSubCategoryById($data['sub_cat_id']);
        $userdata=new Zend_Session_Namespace( 'userdata' );
        $form = new Application_Form_Thread();
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        if($sub_category[0]['ban_thread'] == 0)
        {    

            if ($user->user_id == $userdata->id)
            {
                $data['thread_user_id']=$user->user_id;
                if($this->getRequest()->isPost())
                {
                    if($form->isValid($data))
                    {
                        if($this->model->addThread($data))
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
        else
        {
            echo "you cannot add thread to this category";
        }    

    }

    public function threaddetailsAction()
    {
        $data = $this->getRequest()->getParam('thread_id');
        //var_dump($data);
        $thread = $this->model->getThreadById($data);
        //var_dump($post);
        $this->view->thread=$thread;
        //$comment = $this->modelcomment->listComments($data);
        //var_dump($comment);
        //$this->view->comments = $this->modelcomment->listComments($data);

    }

    public function deletethreadAction()
    {
        $thread_id = $this->getRequest()->getParam('thread_id');
        $userdata=new Zend_Session_Namespace( 'userdata' );
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        if($thread_id)
        {
            if ($user->user_id == $userdata->id) 
            { 
                $thread = $this->model->getThreadById($thread_id);
                if($thread[0]['thread_user_id']==$user->user_id || $user->user_id == 1)
                { 
                    if($this->model->deleteThread($thread_id))
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
                    $this->redirect('Usercategory/listcategory/user_id/'.$user->user_id);
                }    
            } 
        }
        else
        {
            $this->redirect('Usercategory/listcategory/user_id/'.$user->user_id);
        }   
    }

    public function editthreadAction()
    {
        $thread_id = $this->getRequest()->getParam('thread_id');
        $userdata=new Zend_Session_Namespace( 'userdata' );
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();

        if($thread_id)
        {
            if ($user->user_id == $userdata->id) 
            {
                $thread = $this->model->getThreadById($thread_id);
                if($thread[0]['thread_user_id']==$user->user_id || $user->user_id == 1)
                {
                    $form = new Application_Form_Thread();
                    $form->populate($thread[0]);
                    $this->view->form = $form;
                    if($this->getRequest()->isPost())
                    {   
                        $data = $this->getRequest()->getParams();
                        if($form->isValid($data))
                        {    
                            if($this->model->editThread($thread_id, $data))
                            {
                                $this->redirect('Usercategory/listcategory/user_id/'.$user->user_id);
                            }
                        }       
        
                    }
                } 

            }

        }
        else
        {
            $this->redirect('Usercategory/listcategory/user_id/'.$user->user_id);
        }

    }

    public function stickythreadAction()
    {
        $thread_id = $this->getRequest()->getParam('thread_id');
        $userdata=new Zend_Session_Namespace( 'userdata' );
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        if($thread_id)
        {
            if ($user->user_id == $userdata->id && $user->admin == 1)
            {
                $data['sticky']=1;
                if($this->model->stickythread($thread_id, $data))
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

    public function releasestickythreadAction()
    {
        $thread_id = $this->getRequest()->getParam('thread_id');
        $userdata=new Zend_Session_Namespace( 'userdata' );
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        if($thread_id)
        {
            if ($user->user_id == $userdata->id && $user->admin == 1)
            {
                $data['sticky']=0;
                if($this->model->stickythread($thread_id, $data))
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













