<?php
namespace Home\Controller;
use Think\Controller;
class WorkorderController extends BaseController {
    public function index(){
    }

    public function newwork(){
        if($_POST){

            if(!$_POST['title']){
                echo  $this->error('标题不能为空');
            }
            if(!$_POST['content']){
                echo  $this->error('内容不能为空');
            }
            //将新建工单数据保存数据库
            $uid = session(C('USER_AUTH_KEY'));
            $data = array(
                'title' => $_POST['title'],
                'rank' => $_POST['rank'],
                'content' => $_POST['content'],
                'file_id' => $_POST['fileid'],
                'img_id' => $_POST['imgid'],
                'user_id' =>$uid,
                );
            $is =D('Workorder')->Insert($data);
        }

        $this->display();
    }



    public function allwork(){
        $roleid = session('role_id');
        $this->assign('rid',$roleid);
        //删除
     if($_POST){
        $arr = explode(',', $_POST['idarr']);
        foreach($arr as $k => $v){
           $is =D('Workorder')->deleteById($v);
       }
   }
   //$is =D('Workorder')->selectall();
//分页查询
   $page  = $_REQUEST['p']  ?   $_REQUEST['p'] : 1;

   $pagesize =  $_REQUEST['pagesize'] ? $_REQUEST['pagesize'] : 8;
if($_GET['status']){

    $menus = D('Workorder')->getalls('status',$_GET['status'],$page,$pagesize);

    $menucount = D('Workorder')->getallCount('status',$_GET['status']);


}else{

    $menus = D('Workorder')->getall($page,$pagesize);

    $menucount = D('Workorder')->getallCount(0,0);
}


$res = new \Think\Page($menucount,$pagesize);

$pageRes = $res->show();
$this ->assign('pageRes',$pageRes);
        //$this ->assign('menus',$menus);
$this->assign('list',$menus);
$this->display();

}


}