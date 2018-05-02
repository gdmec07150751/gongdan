<?php
/**
 * Created by PhpStorm.
 * User: yirsion
 * Date: 2018-04-15
 * Time: 0:59
 */

namespace Home\Controller;

use Think\Controller;
class FileController extends Controller
{
    public function ajaxuploadfile(){
        if(!empty($_FILES)){
                Vendor('pdfu.Pdfa');
                $pdf =  new \pdf();
            import("@.Think.UploadFile");
            $upload = new \Think\Upload();
            $upload->rootPath  = 'upload/files/';//根路径
            $upload->savePath = date('Y').'/'.date('m').'/'.date('d').'/';//子路径
            $upload->exts = array('doc', 'xls', 'mp4', 'avi', 'docx', 'xlsx');//可以上传的文件类型  BMP、JPG、JPEG、PNG、GIF
            $upload->autoSub = false;
            $upload->saveRule = uniqid; //上传规则，文件名会自动重新获取
            $info = $upload->upload();
            $fileArray = "";
            if(!$info){
                echo $this->error($upload->getError());//获取失败信息
            } else{

                for($i=0;$i<count($info);$i++){

                    $arr[] = $info[$i]['savepath'].$info[$i]['savename'];

$input_url1 = dirname(dirname(dirname(dirname(__FILE__)))).'/upload/files/'.$info[$i]['savepath'].$info[$i]['savename'];
$output_url1 = dirname(dirname(dirname(dirname(__FILE__)))).'/upload/files/'.$info[$i]['savepath'].$info[$i]['savename'].'.pdf';
$pdf->run($input_url1,$output_url1);
    
    $ourl = $info[$i]['savepath'].$info[$i]['savename'].'.pdf';
    
                    $pdfarr[] = $ourl;

                }
            }


            $arr1 = implode("|", $arr);
            $pdfarr1 = implode("|", $pdfarr);
            
                     $filedata = array(
                    'file_url'  =>$arr1,
                    'file_name' =>$_POST['filename'],
                    'file_size' =>$_POST['filesize'],
                    'file_pdf' => $pdfarr1
                );
              $is = D('File')->Insertall($filedata);
               //var_dump($is);exit;
              echo $is;exit;
        }

              


    }
}