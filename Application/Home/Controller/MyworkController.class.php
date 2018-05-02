<?php
namespace Home\Controller;
use Think\Controller;
class MyworkController extends BaseController {
     public function waittingreply(){
        //等待回复状态
        $status = 3;
  $page  = $_REQUEST['p']  ?   $_REQUEST['p'] : 1;

        $pagesize =  $_REQUEST['pagesize'] ? $_REQUEST['pagesize'] : 3;

        $menus = D('Workorder')->getalls($status,$page,$pagesize,$status);

        $menucount = D('Workorder')->getallCount('status',$status);

       $res = new \Think\Page($menucount,$pagesize);

       $pageRes = $res->show();
       $this ->assign('pageRes',$pageRes);
        //$this ->assign('menus',$menus);
        $this->assign('list',$menus);
        $this->display();
     }




    public function myworkorder(){
        $user_id = session(C('USER_AUTH_KEY'));
 $page  = $_REQUEST['p']  ?   $_REQUEST['p'] : 1;

        $pagesize =  $_REQUEST['pagesize'] ? $_REQUEST['pagesize'] : 3;

        $menus = D('Workorder')->getalls('user_id',$user_id,$page,$pagesize,$status);

        $menucount = D('Workorder')->getallCount('user_id',$user_id);

       $res = new \Think\Page($menucount,$pagesize);

       $pageRes = $res->show();
       $this ->assign('pageRes',$pageRes);
        //$this ->assign('menus',$menus);
        $this->assign('list',$menus);
        $this->display();

    }



    public function handleworkorder(){
 

    }


}