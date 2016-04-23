<?php

class Application_Model_DbTable_Usercategory extends Zend_Db_Table_Abstract
{

    protected $_name = 'category';

    function addCategory($data)
	{
		if(isset($data['module']))
			unset($data['module']);
		if(isset($data['controller']))
			unset($data['controller']);
		if(isset($data['action']))
			unset($data['action']);
		if(isset($data['Add']))
			unset($data['Add']);
		if(isset($data['post']))
			unset($data['post']);
		$data['cat_user_id']=$data['user_id'];
		if(isset($data['user_id']))
			unset($data['user_id']);
		$data['cat_time'] =  new Zend_Db_Expr('NOW()');
		return $this->insert($data);
	}

	function listCategory()
	{
		$category = $this->select()->from('category')->join(array('u' => 'users'),'category.cat_user_id = u.user_id',array('u.username'))->setIntegrityCheck(false)->order(array('cat_time'));
		/*$category = $this->select()->from('category')->join(array('s' => 'sub_category'),'category.cat_id = s.cat_id',array('s.sub_cat_id','s.sub_cat_title','s.sub_cat_body','s.sub_cat_user_id','s.cat_id','s.sub_cat_time','s.ban_thread'))->setIntegrityCheck(false)->order(array('cat_time'));*/

		return $this->fetchAll($category);
		//$select = $this->select()->where("userId=".$userId);
		//return $this->fetchAll($select);
	}

	function deleteCategory($id)
	{
		return $this->delete('cat_id='.$id);
	}

	function getCategoryById($id)
	{
		return $this->find($id)->toArray();
	}

	function editCategory($id, $data)
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
        $data['cat_user_id']=$user->user_id;
		//$id=$data['userId'];
		$data['cat_time'] =  new Zend_Db_Expr('NOW()');
		return $this->update($data,'cat_id='.$id);
	}


}

