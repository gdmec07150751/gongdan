<?php
/**
 * Created by PhpStorm.
 * User: yirsion
 * Date: 2018-04-15
 * Time: 0:59
 */

namespace Home\Controller;

use Think\Controller;
class ImgController extends Controller
{
    public function ajaxuploadimg(){

        if(!empty($_FILES)){
            import("@.Think.UploadFile");
            $upload = new \Think\Upload();
            $upload->rootPath  = 'upload/images/';//根路径
            $upload->savePath = date('Y').'/'.date('m').'/'.date('d').'/';//子路径
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'bmp');//可以上传的文件类型  BMP、JPG、JPEG、PNG、GIF
            $upload->autoSub = false;
            $upload->saveRule = uniqid; //上传规则，文件名会自动重新获取
            $info = $upload->upload();
            $fileArray = "";
            if(!$info){
                echo $this->error($upload->getError());//获取失败信息
            } else{

                for($i=0;$i<count($info);$i++){

                    $arr[] = $info[$i]['savepath'].$info[$i]['savename'];
                }
            }
          $arr1 = implode("|", $arr);
            
            
                     $imgdata = array(
                    'img_url'  =>$arr1,
                    'img_name' =>$_POST['imgname'],
                    'img_size' =>$_POST['imgsize'],
                );

                     //print_r($imgdata);exit;
              $is = D('Img')->Insertall($imgdata);
               //var_dump($is);exit;
              echo $is;exit;
        }







    }
   
}