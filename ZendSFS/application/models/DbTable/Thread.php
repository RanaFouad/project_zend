<?php

class Application_Model_DbTable_Thread extends Zend_Db_Table_Abstract
{

    protected $_name = 'threads';


	function addThread($data)
	{
		if(isset($data['module']))
			unset($data['module']);
		if(isset($data['controller']))
			unset($data['controller']);
		if(isset($data['action']))
			unset($data['action']);
		if (isset($data['Add']))
			unset($data['Add']);
		
		
		$data['thread_time'] =  new Zend_Db_Expr('NOW()');	
		$data['sticky'] = 0;
			
		return $this->insert($data);
	}

	function list_all_thread()
	{
		//return $this->fetchAll()->toArray();
		$select= $this->select()->from('threads')->order(array('sticky'));
		return $this->fetchAll($select);
	}

	function getThreadById($id)
	{
		return $this->find($id)->toArray();
	}

	function deleteThread($id)
	{
		return $this->delete('thread_id='.$id);
	}

	function editThread($id, $data)
	{
		if(isset($data['module']))
			unset($data['module']);
		if(isset($data['controller']))
			unset($data['controller']);
		if(isset($data['action']))
			unset($data['action']);
		if(isset($data['submit']))
			unset($data['submit']);
		if(isset($data['Add']))
			unset($data['Add']);
		$auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        $data['thread_user_id']=$user->user_id;
		//$id=$data['userId'];
		$data['thread_time'] = new Zend_Db_Expr('NOW()');
		return $this->update($data,'thread_id='.$id);
	}

	function stickythread($id, $data)
	{
		return $this->update($data,'thread_id='.$id);	
	}

}

