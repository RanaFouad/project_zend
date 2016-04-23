<?php

class Application_Model_DbTable_SubCategory extends Zend_Db_Table_Abstract
{

    protected $_name = 'sub_category';


	function list_sub_category($id)
	{
		//return $this->find($id)->toArray();
		$select = $this->select()->where('cat_id='.$id);
		return $this->fetchAll($select);

	}

	function list_all_sub_category()
	{
		//return $this->find($id)->toArray();
		//$select = $this->select()->where('cat_id='.$id);
		//return $this->fetchAll($select);
		return $this->fetchAll()->toArray();
	}


	function addFourm($data)
	{
		if(isset($data['module']))
			unset($data['module']);
		if(isset($data['controller']))
			unset($data['controller']);
		if(isset($data['action']))
			unset($data['action']);
		if(isset($data['submit']))
			unset($data['submit']);
		if(isset($data['post']))
			unset($data['post']);
		if (isset($data['Add']))
		{
			unset($data['Add']);
		}
		
		$data['sub_cat_time'] =  new Zend_Db_Expr('NOW()');	
		$data['ban_thread'] = 0;
			
		return $this->insert($data);
	}

	function deletesubCategory($id)
	{
		return $this->delete('sub_cat_id='.$id);
	}

	function getSubCategoryById($id)
	{
		return $this->find($id)->toArray();
	}

	function editSubCategory($id, $data)
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
		if(isset($data['post']))
			unset($data['post']);
		if(isset($data['postId']))
			unset($data['postId']);
		$auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        $data['sub_cat_user_id']=$user->user_id;
		//$id=$data['userId'];
		$data['sub_cat_time'] =  new Zend_Db_Expr('NOW()');
		return $this->update($data,'sub_cat_id='.$id);
	}

	function banthread($id, $data)
	{
		return $this->update($data,'sub_cat_id='.$id);	
	}

}

