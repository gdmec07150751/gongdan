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
        //print_r($_FILES);exit;
        if(!empty($_FILES)){
                //Vendor('pdfu.Pdfa');
                //$pdf =  new \pdf();
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
//$pdf->run($input_url1,$output_url1);
    //.$input_url1." ".$output_url1;
$input_url1 = dirname(dirname(dirname(dirname(__FILE__)))).'/upload/files/'.$info[$i]['savepath'].$info[$i]['savename'];


$output_url1 = dirname(dirname(dirname(dirname(__FILE__)))).'/upload/files/'.$info[$i]['savepath'].$info[$i]['savename'].'.pdf';
///home/wwwroot/foa/upload/files/2018/05/10/5af407a603dd9.docx
///home/wwwroot/foa/upload/files/2018/05/10/5af407a603dd9.docx.pdf
//java -jar /opt/jodconverter-2.2.2/lib/jodconverter-cli-2.2.2.jar /home/wwwroot/foa/upload/files/2018/05/10/5af407a603dd9.docx /home/wwwroot/foa/upload/files/2018/05/10/5af407a603dd9.docx.pdf
//java -jar /opt/jodconverter-2.2.2/lib/jodconverter-cli-2.2.2.jar home/wwwroot/foa/upload/files/2018/05/10/5af407a603dd9.docx home/wwwroot/foa/upload/files/2018/05/10/5af407a603dd9.docx.pdf
//java -jar /opt/jodconverter-2.2.2/lib/jodconverter-cli-2.2.2.jar home/wwwroot/foa/upload/files/2018/05/14/1.docx home/wwwroot/foa/upload/files/2018/05/14/1.docx.pdf
//$pdf->run($input_url1,$output_url1);

/*print_r($input_url1);
print_r($output_url1);*/
//try{
// . $input_url1 . " " . $output_url1
$command ="java -jar /opt/jodconverter-2.2.2/lib/jodconverter-cli-2.2.2.jar /home/wwwroot/foa/upload/files/2018/05/14/1.docx /home/wwwroot/foa/upload/files/2018/05/14/1.docx.pdf";
//$command= "java -jar /opt/jodconverter-2.2.2/lib/jodconverter-cli-2.2.2.jar 1.docx 1.pdf";
//print_r($command);
//print_r($command);exit;
$wordpath = "/home/wwwroot/foa/upload/files/2018/05/14/1.docx";
$outPdfPath="/home/wwwroot/foa/upload/files/2018/05/14/1.docx.pdf";
$jodconverterPath = "/opt/jodconverter-2.2.2/lib/jodconverter-cli-2.2.2.jar";

//print_r("对一遍");
$this->word2pdf($wordpath,$outPdfPath,$jodconverterPath);
//print_r(echo exec($command,$out));
//print_r("对了");
//}catch(Exception $e){
    //print_r($e);
    //print_r("错了");
//}
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
 
              echo $is;exit;
        }

              


    }




    function word2pdf ($wordpath, $outPdfPath, $jodconverterPath) {
    if (empty($wordpath)) return false;    
    try {
        //这里是因为我吧Java（jdk/jre）加入了环境变量,故可直接写出下面这样， 
        //相当于cmd窗口下直接写 java -jar jodconverter-cli-2.2.2.jar所在路径 word文件 PDF文件
        $p = "java -jar ". $jodconverterPath . ' ' . $wordpath . ' ' . $outPdfPath;
        // 否则该前面应该加入jre/jdk的路径
        exec($p);
        return true;
    } catch (Exception $e) {
        return false;
    }
}
}