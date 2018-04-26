<?php
namespace Home\Model;
use Think\Model;

/**
 * 用户组操作
 * @author  singwa
 */
class WorkorderModel extends Model {
private $_db = '';

	public function __construct() {
		$this->_db = M('workorder');
	}

public function Insert($data = array()){
      if(!$data || !is_array($data)) {
            return 0;
        }
        return $this->_db->add($data);
}

public function selectall(){
    return $this->_db->select();
}


//将数据分页
    public function getall($page,$pagesize=10){
        //$menu_data = M('menu');
        //$data['status'] = array('neq',-1);
         $offpage =  ($page-1) * $pagesize;
         $list = $this->_db->order("id desc")->limit($offpage,$pagesize)->select();
         return $list;
    }

//计算总数据数量
    public function getallCount(){
      //$data['status'] = array('neq',-1);
      return $this->_db->count();
    }

    //将数据分页
    public function getalls($status,$page,$pagesize=10){
        //$menu_data = M('menu');
        //$data['status'] = array('neq',-1);
         $offpage =  ($page-1) * $pagesize;
         $list = $this->_db->where('status='.$status)->order("id desc")->limit($offpage,$pagesize)->select();
         return $list;
    }

//计算总数据数量
    public function getallCounts($status){
      //$data['status'] = array('neq',-1);
      return $this->_db->where('status='.$status)->count();
    }





public function deleteById($v){

return $this->_db->delete($v);
}
public function selectOne($id){
return $this->_db
            ->where('id='.$id)
            ->find();
}
public function selectOnewi($id){
return $this->_db
            ->join('oa_img ON oa_workorder.img_id = oa_img.img_id' )
            ->where('id='.$id)
            ->find();
}
public function selectOnewf($id){
return $this->_db
            ->join('oa_file ON oa_workorder.file_id = oa_file.file_id' )
            ->where('id='.$id)
            ->find();
}

public function updatelevel($id,$data){
   return $this->_db->where('id='.$id)->save($data);
}
/*public function selectwithstatus($status){
return $this->_db->where('status='.$status)->select();
}*/
}