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
//添加工单
public function Insert($data = array()){
      if(!$data || !is_array($data)) {
            return 0;
        }
        return $this->_db->add($data);
}
//查询所有工单
public function selectall(){
    return $this->_db->select();
}



//分页查询所有工单
//将数据分页
    public function getall($page,$pagesize=10){
        //$menu_data = M('menu');
        //$data['status'] = array('neq',-1);
         $offpage =  ($page-1) * $pagesize;
         $list = $this->_db->order("id desc")->limit($offpage,$pagesize)->select();
         return $list;
    }

//分页根据查询工单
    //将数据分页
    public function getalls($name,$value,$page,$pagesize=10){
         $offpage =  ($page-1) * $pagesize;
         $list = $this->_db->where($name.'='.$value)->order("id desc")->limit($offpage,$pagesize)->select();
         return $list;
    }



//计算总数据数量
    public function getallCount($name,$value){
      if($name == 0&&$value==0){
        return $this->_db->count();
      }else{
        return $this->_db->where($name.'='.$value)->count();
      }
      
    }










//删除工单
public function deleteById($v){

return $this->_db->delete($v);
}
//根据id查询工单
public function selectOne($id){
return $this->_db
            ->where('id='.$id)
            ->find();
}
//根据id查询工单关联图片
public function selectOnewi($id){
return $this->_db
            ->join('oa_img ON oa_workorder.img_id = oa_img.img_id' )
            ->where('id='.$id)
            ->find();
}
//根据id查询工单关联文件
public function selectOnewf($id){
return $this->_db
            ->join('oa_file ON oa_workorder.file_id = oa_file.file_id' )
            ->where('id='.$id)
            ->find();
}
//根据id修改级别和状态
public function updatelevel($id,$data){
   return $this->_db->where('id='.$id)->save($data);
}

//查询该用户发布的所有工单
public function selectmywork($user_id){
   return $this->_db->where('user_id='.$user_id)->select();
}
}