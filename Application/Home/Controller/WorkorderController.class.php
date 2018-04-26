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
          //print_r($_POST['fileid']);exit;
            $data = array(
                'title' => $_POST['title'],
                'rank' => $_POST['rank'],
                'content' => $_POST['content'],
                'file_id' => $_POST['fileid'],
                'img_id' => $_POST['imgid'],
            );
            $is =D('Workorder')->Insert($data);
        }

        $this->display();
    }



    public function allwork(){
   if($_POST){
    $arr = explode(',', $_POST['idarr']);
    foreach($arr as $k => $v){
     $is =D('Workorder')->deleteById($v);
    }
   }
        $is =D('Workorder')->selectall();

if($_GET['status']){
 
$page  = $_REQUEST['p']  ?   $_REQUEST['p'] : 1;

        $pagesize =  $_REQUEST['pagesize'] ? $_REQUEST['pagesize'] : 3;

        $menus = D('Workorder')->getalls($_GET['status'],$page,$pagesize);

        $menucount = D('Workorder')->getallCounts($_GET['status']);

       $res = new \Think\Page($menucount,$pagesize);

       $pageRes = $res->show();
       $this ->assign('pageRes',$pageRes);
        //$this ->assign('menus',$menus);
        $this->assign('list',$menus);
        $this->display();

}else{

$page  = $_REQUEST['p']  ?   $_REQUEST['p'] : 1;

        $pagesize =  $_REQUEST['pagesize'] ? $_REQUEST['pagesize'] : 3;

        $menus = D('Workorder')->getall($page,$pagesize);

        $menucount = D('Workorder')->getallCount();

       $res = new \Think\Page($menucount,$pagesize);

       $pageRes = $res->show();
       $this ->assign('pageRes',$pageRes);
        //$this ->assign('menus',$menus);
        $this->assign('list',$menus);
        $this->display();

}



    }


}