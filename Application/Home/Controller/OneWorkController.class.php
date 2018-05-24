<?php
namespace Home\Controller;
use Think\Controller;
class OneWorkController extends BaseController {

//查看工单
  public function checkcontent(){
  //获取处理人ID
    $solve_uid = session(C('USER_AUTH_KEY'));
//获取ID看是否管理员或者用户
    $roleid = session('role_id');
   //用户名
    $authid = session('user_name');

    $this->assign('rid',$roleid);

    $this->assign('sid',$solve_uid);

//是否有改变状态
    if($_POST['status']){
    //是否有改变级别
     if($_POST['rank']){
       $status = $_POST['status'];
       $rank = $_POST['rank'];
       //工单ID
       $id = $_POST['id'];
       $data = array(
        'status' => $status,
        'rank' => $rank
        );
  //改变工单状态
       $is =D('Workorder')->updatelevel($id,$data);

   //当前时间 管理员自动回复数据
       $odate=date("Y-m-d H:i:s"); 
       $a ='未处理';
       if($status==1){$a="未处理";}
       elseif($status==2){$a="处理中";}
       elseif($status==3){$a="等待回复";}
       elseif($status==4){$a="已完成";}
       $data = array(
        'user' => $authid,
        'content' => '管理员'.$authid.'将该工单状态改为'.$a,
        'time' => $odate,
        'workorder_id' => $_POST['id'],
        );
        //自动插入管理员回复
       $managereturn =D('OneWork')->Insert($data);
     }else{
  //如果不存在Rank  进入接受或取消处理工单
      //处理人id
      $sid = $_POST['sid'];
      $status = $_POST['status'];
      //工单ID
      $id = $_POST['id'];
      $data = array(
        'status' => $status,
        'solve_uid' => $solve_uid,
        );
      $data1 = array(
        'status' => $status,
        'solve_uid' => 0,
        );
      //事先没有处理人则点击为处理该工单
      if($sid ==0){
        $is =D('Workorder')->updatelevel($id,$data);
    //管理员自动回复
        $odate=date("Y-m-d H:i:s"); 
        $data = array(
          'user' => $authid,
          'content' => '管理员'.$authid.'已经查看该工单，请等待处理…',
          'time' => $odate,
          'workorder_id' => $_POST['id'],
          );
        $managereturn =D('OneWork')->Insert($data);
      }else{
        //否则取消处理该工单
        $is =D('Workorder')->updatelevel($id,$data1);
      }

   //$this->assign('sid',$solve_uid);
    }


  }






//将留言板存进数据库
  if($_POST['content']){
    $authid = session('user_name');
    $odate=date("Y-m-d H:i:s"); 

    $data = array(
      'user' => $authid,
      'content' => $_POST['content'],
      'time' => $odate,
      'workorder_id' => $_POST['id'],
      'img_id' => $_POST['imgid'],
      'file_id' => $_POST['fileid'],
      );
    $is =D('OneWork')->Insert($data);
  }






//显示工单内容
  if($_GET){
    //工单ID
    $id = $_GET['id'];
    $is =D('Workorder')->selectOne($id);
    $iswu =D('Workorder')->selectOnewu($id);
    $this->assign('iswu',$iswu);
    //工单里否否有图片  有就显示
    if($is['img_id']&&$is['img_id']!=0){
      $iswi = D('Workorder')->selectOnewi($id);
      //取出数据 处理
      $imgarr = explode('|', $iswi['img_url']);
      $this->assign('il',count($imgarr));
      $this->assign('imgarr',$imgarr);
    }
    //工单里否否有文件  有就显示
    if($is['file_id']&&$is['file_id']!=0){
      $iswf = D('Workorder')->selectOnewf($id);
      //取出数据 处理
      $fileurlarr = explode('|', $iswf['file_url']);
      $filenamearr = explode('|', $iswf['file_name']);
      $filesizearr = explode('|', $iswf['file_size']);
      $filepdfarr = explode('|', $iswf['file_pdf']);
      //重新组成二维数组
      foreach ($fileurlarr as $key => $value) {
       $filearr[$key]['file_url'] = $fileurlarr[$key];
       $filearr[$key]['file_name'] = $filenamearr[$key];
       $filearr[$key]['file_size'] = $filesizearr[$key];
       $filearr[$key]['file_pdf'] = $filepdfarr[$key];
     }
     //有多少个文件
     $this->assign('fl',count($filearr));
     $this->assign('filearr',$filearr);
   }


   $this->assign('gid',$id);

   $this->assign('onelist',$is);

 }


//显示留言板内容
 if($_POST['id']){
  $id = $_POST['id'];
}else{
  $id = $_GET['id'];
}
//查询该工单所有留言内容
$sa =D('OneWork')->selectall($id);

//判断是否有图片
for($i=0;$i<count($sa);$i++){
  if($sa[$i]['img_id']&&$sa[$i]['img_id'] != 0){
   $sa[$i]['img_url'] = explode('|', $sa[$i]['img_url']);
 }else{
  $sa[$i]['img_url']  = array();
}
}

//判断是否有文件
for($i=0;$i<count($sa);$i++){
  if($sa[$i]['file_id']&&$sa[$i]['file_id'] != 0){
   $sa[$i]['file_url'] = explode('|', $sa[$i]['file_url']);
   $sa[$i]['file_name'] = explode('|', $sa[$i]['file_name']);
   $sa[$i]['file_size'] = explode('|', $sa[$i]['file_size']);
   $sa[$i]['file_pdf'] = explode('|', $sa[$i]['file_pdf']);
 }else{
  $sa[$i]['file_url']  = array();
}

//重新生成二维数组
foreach ($sa[$i]['file_url'] as $key => $value) {
 $saa[$i][$key]['url'] = $sa[$i]['file_url'][$key];
 $saa[$i][$key]['name'] = $sa[$i]['file_name'][$key];
 $saa[$i][$key]['pdf'] = $sa[$i]['file_pdf'][$key];;
}
$sa[$i]['file_url'] = $saa[$i];
}


/*if($sa['file_id']&&$sa['file_id']!=0){
  $sawf = D('OneWork')->selectallwf($id);
  $lyfileurlarr = explode('|', $sawf['file_url']);
  $lyfilenamearr = explode('|', $sawf['file_name']);
  $lyfilesizearr = explode('|', $sawf['file_size']);
  $lyfilepdfarr = explode('|', $sawf['file_pdf']);
  foreach ($fileurlarr as $key => $value) {
   $lyfilearr[$key]['file_url'] = $lyfileurlarr[$key];
   $lyfilearr[$key]['file_name'] = $lyfilenamearr[$key];
   $lyfilearr[$key]['file_size'] = $lyfilesizearr[$key];
   $lyfilearr[$key]['file_pdf'] = $lyfilepdfarr[$key];
 }

}*/

        //列表数组分页 
        //$sa = array_reverse($sa);     
         $count=count($sa);
         $Page=new \Think\Page($count,4);
         $show = $Page->show();
         $list=array_slice($sa,$Page->firstRow,$Page->listRows);
        //$this->assign('list',$list);// 赋值数据集
         //留言总条数
         $this->assign('le',count($list));
         //输出新组成的留言数据
         $this->assign('sa',$list);
         //输出分页
         $this->assign('page',$show);// 赋值分页输出

         $this->display();
       }
     }