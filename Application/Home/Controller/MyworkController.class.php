<?php
namespace Home\Controller;
use Think\Controller;
class MyworkController extends BaseController {
     public function waittingreply(){
        //等待回复状态
      $roleid = session('role_id');
      $user_id = session(C('USER_AUTH_KEY'));
$this->assign('rid',$roleid);
        $status = 3;
  $page  = $_REQUEST['p']  ?   $_REQUEST['p'] : 1;

        $pagesize =  $_REQUEST['pagesize'] ? $_REQUEST['pagesize'] : 8;

        $menus = D('Workorder')->getmys('user_id',$user_id,'status',$status,$page,$pagesize);

        $menucount = D('Workorder')->getmyCount('user_id',$user_id,'status',$status);

       $res = new \Think\Page($menucount,$pagesize);

       $pageRes = $res->show();
       $this ->assign('pageRes',$pageRes);
        //$this ->assign('menus',$menus);
        $this->assign('list',$menus);
        $this->display();
     }




    public function myworkorder(){

$roleid = session('role_id');
$this->assign('rid',$roleid);

 $user_id = session(C('USER_AUTH_KEY'));



 $page  = $_REQUEST['p']  ?   $_REQUEST['p'] : 1;

        $pagesize =  $_REQUEST['pagesize'] ? $_REQUEST['pagesize'] : 8;
if($_GET){
 
        $menus = D('Workorder')->getalls($_GET['status'],$_GET['rank'],$_GET['leibie'],$page,$pagesize,-1,$user_id);

        $menucount = D('Workorder')->getallCount($_GET['status'],$_GET['rank'],$_GET['leibie'],-1,$user_id);

}else{

        $menus = D('Workorder')->getalls(0,0,0,$page,$pagesize,-1,$user_id);

        $menucount = D('Workorder')->getallCount(0,0,0,-1,$user_id);
}

       $res = new \Think\Page($menucount,$pagesize);

       $pageRes = $res->show();
       //$this->assign('uid',$user_id);
       $this ->assign('pageRes',$pageRes);
        //$this ->assign('menus',$menus);
        $this->assign('list',$menus);
        $this->display();
    }



    public function handleworkorder(){

      $user_id = session(C('USER_AUTH_KEY'));

  $page  = $_REQUEST['p']  ?   $_REQUEST['p'] : 1;

        $pagesize =  $_REQUEST['pagesize'] ? $_REQUEST['pagesize'] : 8;

if($_GET){
 
        $menus = D('Workorder')->getalls($_GET['status'],$_GET['rank'],$_GET['leibie'],$page,$pagesize,$user_id,-1);

        $menucount = D('Workorder')->getallCount($_GET['status'],$_GET['rank'],$_GET['leibie'],$user_id,-1);

}else{

        $menus = D('Workorder')->getalls(0,0,0,$page,$pagesize,$user_id,-1);

        $menucount = D('Workorder')->getallCount(0,0,0,$user_id,-1);
}
       $res = new \Think\Page($menucount,$pagesize);

       $pageRes = $res->show();
       $this ->assign('pageRes',$pageRes);
        //$this ->assign('menus',$menus);
        $this->assign('list',$menus);
        $this->display();

    }


}