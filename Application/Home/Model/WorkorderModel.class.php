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
         $offpage =  ($page-1) * $pagesize;
         $list = $this->_db->where('del=1')->order("id desc")->limit($offpage,$pagesize)->select();
         //print_r($list);exit;
         return $list;
    }

//分页根据查询工单
    //将数据分页
    public function getalls($status,$rank,$leibie,$page,$pagesize=10){
         $offpage =  ($page-1) * $pagesize;
          


         if($status==0&&$rank!=0&&$leibie!=0){
$list = $this->_db->where('rank='.$rank.' and leibie='.$leibie.' and del=1')->order("id desc")->limit($offpage,$pagesize)->select();

         }


         if($status==0&&$rank==0&&$leibie!=0){
$list = $this->_db->where('leibie='.$leibie.' and del=1')->order("id desc")->limit($offpage,$pagesize)->select();

         }


         if($status==0&&$rank!=0&&$leibie==0){
$list = $this->_db->where('rank='.$rank.' and del=1')->order("id desc")->limit($offpage,$pagesize)->select();

         }

         if($status!=0&&$rank==0&&$leibie==0){
$list = $this->_db->where('status='.$status.' and del=1')->order("id desc")->limit($offpage,$pagesize)->select();

         }


          if($rank==0&&$status!=0&&$leibie!=0){
$list = $this->_db->where('status='.$status.' and leibie='.$leibie.' and del=1')->order("id desc")->limit($offpage,$pagesize)->select();
         }



          if($leibie==0&&$rank!=0&&$status!=0){
$list = $this->_db->where('status='.$status.' and rank='.$rank.' and del=1')->order("id desc")->limit($offpage,$pagesize)->select();
         }

         if($status!=0&&$rank!=0&&$leibie!=0){
           $list = $this->_db->where('status='.$status.' and rank='.$rank.' and leibie='.$leibie.' and del=1')->order("id desc")->limit($offpage,$pagesize)->select();
         }


         if($status==0&&$rank==0&&$leibie==0){
            $list = $this->_db->where('del=1')->order("id desc")->limit($offpage,$pagesize)->select();
         }


         return $list;


    }

//计算总数据数量
    public function getallCount($status,$rank,$leibie){
      if($status==0&&$rank==0&&$leibie==0){
        return $this->_db->where('del=1')->count();
      }
   if($status!=0&&$rank!=0&&$leibie!=0){
        $count=$this->_db->where('status='.$status.' and rank='.$rank.' and leibie='.$leibie.' and del=1')->count();
      }


if($status==0&&$rank!=0&&$leibie!=0){
    $count=$this->_db->where('rank='.$rank.' and leibie='.$leibie.' and del=1')->count();
}


if($status==0&&$rank==0&&$leibie!=0){
    $count=$this->_db->where('leibie='.$leibie.' and del=1')->count();
}

if($status==0&&$rank!=0&&$leibie==0){
    $count=$this->_db->where('rank='.$rank.' and del=1')->count();
}
if($status!=0&&$rank==0&&$leibie==0){
    $count=$this->_db->where('status='.$status.' and del=1')->count();
}

if ($rank==0&&$status!=0&&$leibie!=0) {
    $count=$this->_db->where('status='.$status.' and leibie='.$leibie.' and del=1')->count();
}



if($leibie==0&&$status!=0&&$rank!=0){
    $count=$this->_db->where('status='.$status.' and rank='.$rank.' and del=1')->count();   
}


        
      return $count;
    }


//分页查询我的工单

  public function getmys($name,$value,$name1,$value1,$page,$pagesize=10){
         $offpage =  ($page-1) * $pagesize;
          

         $list = $this->_db->where($name.'='.$value.' and '.$name1.'='.$value1.' and del=1')->order("id desc")->limit($offpage,$pagesize)->select();
         return $list;


    }

//计算总数据数量
    public function getmyCount($name,$value,$name1,$value1){
        return $this->_db->where($name.'='.$value.' and '.$name1.'='.$value1.' and del=1')->count();
 
    }





//删除工单
public function deleteById($id,$data){

//return $this->_db->delete($v);
return $this->_db->where('id='.$id)->save($data);

}
//根据id查询工单
public function selectOne($id){
return $this->_db
   ->join('LEFT JOIN oa_user ON oa_workorder.solve_uid = oa_user.id')
            ->where('oa_workorder.id='.$id)
            ->find();
}

//关联uid
public function selectOnewu($id){
return $this->_db
   ->join('LEFT JOIN oa_user ON oa_workorder.user_id = oa_user.id')
            ->where('oa_workorder.id='.$id)
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