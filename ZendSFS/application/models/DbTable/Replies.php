<?php

class Application_Model_DbTable_Replies extends Zend_Db_Table_Abstract
{

    protected $_name = 'replies';


    function addreplay($id,$replay,$uid){
    	$data = array('reply_user_id' => $uid,'reply_body'=>$replay,'thread_id'=>$id
    	,'reply_time' =>  new Zend_Db_Expr('NOW()' ));
    	return $this->insert($data);
      




    }
    //////////////////////////Get Replaies///////////////////////////////////
    function getReplies(){
    	   return $this->fetchAll()->toArray();
 }
 ///////////////////////////Delete Replay//////////////
    function deleteReply($id){
      return $this->delete('reply_id='.$id);
    }

///////////////////////////Get reply by id
  function  getReply($replay_id){


         return $this->find($replay_id)->toArray();
}
function editReply($replay_id,$reply){

$data = array(
    'reply_body' => $reply);
   $where = "reply_id = " . $replay_id;

        
    
  return  $this->update($data, $where );


}


}

