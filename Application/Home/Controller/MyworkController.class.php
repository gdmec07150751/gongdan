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
if($_GET['status']){
 
        $menus = D('Workorder')->getmys('user_id',$user_id,'status',$_GET['status'],$page,$pagesize);

        $menucount = D('Workorder')->getmyCount('user_id',$user_id,'status',$_GET['status']);

}else{

        $menus = D('Workorder')->getalls('user_id',$user_id,$page,$pagesize,$status);

        $menucount = D('Workorder')->getallCount('user_id',$user_id);
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

        //$status = 3;

  $page  = $_REQUEST['p']  ?   $_REQUEST['p'] : 1;

        $pagesize =  $_REQUEST['pagesize'] ? $_REQUEST['pagesize'] : 8;

if($_GET['status']){

        $menus = D('Workorder')->getmys('solve_uid',$user_id,'status',$_GET['status'],$page,$pagesize);

        $menucount = D('Workorder')->getmyCount('solve_uid',$user_id,'status',$_GET['status']);



}else{
        $menus = D('Workorder')->getalls('solve_uid',$user_id,$page,$pagesize);

        $menucount = D('Workorder')->getallCount('solve_uid',$user_id);


}
       $res = new \Think\Page($menucount,$pagesize);

       $pageRes = $res->show();
       $this ->assign('pageRes',$pageRes);
        //$this ->assign('menus',$menus);
        $this->assign('list',$menus);
        $this->display();

    }


}