<?php
namespace Home\Controller;
use Think\Controller;
class OneWorkController extends BaseController {
    public function index(){
    }

public function checkcontent(){

//改变状态
if($_POST['status']){
	$status = $_POST['status'];
  $rank = $_POST['rank'];
	$id = $_POST['id'];
	$data = array(
      'status' => $status,
      'rank' => $rank
		);
	 $is =D('Workorder')->updatelevel($id,$data);
}



//将留言板存进数据库
if($_POST['content']){
$authid = session('user_name');
$odate=date("Y-m-d H:i:s"); 
//print_r($authid);exit;
//print_r($_POST['imgid']);exit;
//print_r();
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
 $id = $_GET['id'];

 $is =D('Workorder')->selectOne($id);
 //print_r($is['img_id']);exit;
if($is['img_id']&&$is['img_id']!=0){
//print_r('进来了');exit;
  $iswi = D('Workorder')->selectOnewi($id);
 $imgarr = explode('|', $iswi['img_url']);
 $this->assign('imgarr',$imgarr);
}
if($is['file_id']&&$is['file_id']!=0){
  //print_r('进来了');exit;
  $iswf = D('Workorder')->selectOnewf($id);
  $fileurlarr = explode('|', $iswf['file_url']);
  $filenamearr = explode('|', $iswf['file_name']);
  $filesizearr = explode('|', $iswf['file_size']);
  foreach ($fileurlarr as $key => $value) {
     $filearr[$key]['file_url'] = $fileurlarr[$key];
     $filearr[$key]['file_name'] = $filenamearr[$key];
     $filearr[$key]['file_size'] = $filesizearr[$key];
  }
   $this->assign('filearr',$filearr);
}


  $this->assign('gid',$id);
 
 $this->assign('onelist',$is);



}


//显示留言板内容

//该工单的所有内容
//print_r($id);
if($_POST['id']){
  $id = $_POST['id'];
}else{
$id = $_GET['id'];
}
$sa =D('OneWork')->selectall($id);
//$sawi =D('OneWork')->selectallwi($id);
for($i=0;$i<count($sa);$i++){
  if($sa[$i]['img_id']&&$sa[$i]['img_id'] != 0){
 $sa[$i]['img_url'] = explode('|', $sa[$i]['img_url']);
}else{
  $sa[$i]['img_url']  = array();
}
//print_r($sa[$i]['img_url']);
}

for($i=0;$i<count($sa);$i++){
  if($sa[$i]['file_id']&&$sa[$i]['file_id'] != 0){
 $sa[$i]['file_url'] = explode('|', $sa[$i]['file_url']);
 $sa[$i]['file_name'] = explode('|', $sa[$i]['file_name']);
 $sa[$i]['file_size'] = explode('|', $sa[$i]['file_size']);
}else{
  $sa[$i]['file_url']  = array();
 /* $sa[$i]['file_url']  = array();
  $sa[$i]['file_size']  = array();*/
}
  foreach ($sa[$i]['file_url'] as $key => $value) {
     $saa[$i][$key]['url'] = $sa[$i]['file_url'][$key];
      $saa[$i][$key]['name'] = $sa[$i]['file_name'][$key];
     //$filearr[$key]['file_size'] = $filesizearr[$key];
  }
  $sa[$i]['file_url'] = $saa[$i];
//print_r($saa[$i]);
}

if($sa['file_id']&&$sa['file_id']!=0){
  //print_r('进来了');exit;
  $sawf = D('OneWork')->selectallwf($id);
  $lyfileurlarr = explode('|', $sawf['file_url']);
  $lyfilenamearr = explode('|', $sawf['file_name']);
  $lyfilesizearr = explode('|', $sawf['file_size']);
  foreach ($fileurlarr as $key => $value) {
     $lyfilearr[$key]['file_url'] = $lyfileurlarr[$key];
     $lyfilearr[$key]['file_name'] = $lyfilenamearr[$key];
     $lyfilearr[$key]['file_size'] = $lyfilesizearr[$key];
  }
  
}

        //列表数组分页 
        $sa = array_reverse($sa);     
        $count=count($sa);
        $Page=new \Think\Page($count,4);
        $show = $Page->show();
        $list=array_slice($sa,$Page->firstRow,$Page->listRows);
        //$this->assign('list',$list);// 赋值数据集
	       $this->assign('sa',$list);
         $this->assign('page',$show);// 赋值分页输出

     
    $this->display();
}
}