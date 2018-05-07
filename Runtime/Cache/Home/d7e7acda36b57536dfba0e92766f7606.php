<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    
    <!-- FontAwesome 4.3.0 -->
 	<link href="/Public/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="/Public/js/baidueditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">

    <!-- Ionicons 2.0.0 --
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/Public/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
    	folder instead of downloading all of them to reduce the load. -->
    <link href="/Public/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="/Public/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />  


    <link href="/Public/css/uploadImg.css" rel="stylesheet" type="text/css" /> 
<link href="/Public/css/uploadFile.css" rel="stylesheet" type="text/css" /> 
    <!-- <link href="/Public/css/IMGUP.css" rel="stylesheet" /> -->

    
    <!-- jQuery 2.1.4 -->

    <script src="/Public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="/Public/js/global.js"></script>
    <script src="/Public/js/myFormValidate.js"></script>    
    <script src="/Public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/Public/js/layer/layer-min.js"></script><!-- 弹窗js 参考文档 http://layer.layui.com/--> <script src="/Public/js/layer/layer.js"></script><!--弹窗js 参考文档 http://layer.layui.com/--> 
  <script src="/Public/js/layer/dialog.js"></script>
    <script src="/Public/js/myAjax.js"></script>
    <script src="/Public/js/laydate/laydate.js"></script>
    <script type="text/javascript" src="/Public/js/baidueditor/third-party/jquery.min.js"></script>
      <script src="/Public/js/baidueditor/umeditor.config.js"></script>
  <script src="/Public/js/baidueditor/umeditor.min.js"></script>
  <script type="text/javascript" src="/Public/js/baidueditor/lang/zh-cn/zh-cn.js"></script>


    <script type="text/javascript">
    function delfun(obj){
    	layer.confirm('确认删除？', {
    		  btn: ['确定','取消'] //按钮
    		}, function(){
   				$.ajax({
   					type : 'post',
   					url : $(obj).attr('data-url'),
   					data : {act:'del',del_id:$(obj).attr('data-id')},
   					dataType : 'json',
   					success : function(data){
   						if(data.status==1){
   							layer.alert(data.msg, {icon: 1});
   							$(obj).parent().parent().remove();
   						}else{
   							layer.msg(data, {icon: 2,time: 2000});
   						}
   						layer.closeAll();
   					}
   				})
    		}, function(index){
    			layer.close(index);
    			return false;// 取消
    		}
    	);
    }
    
    //全选
    function selectAll(name,obj){
    	$('input[name*='+name+']').prop('checked', $(obj).checked);
    }   
    </script>        
  </head>
  <body style="background-color:#ecf0f5;">
 

<div class="wrapper">
  <div class="breadcrumbs" id="breadcrumbs">
	<ol class="breadcrumb">
	<?php if(is_array($nav_list)): foreach($nav_list as $k=>$v): if($k == '首页'): ?><li><a href="<?php echo ($v); ?>"><i class="fa fa-home"></i>&nbsp;&nbsp;<?php echo ($k); ?></a></li>
	    <?php else: ?>    
	        <li><a href="<?php echo ($v); ?>"><?php echo ($k); ?></a></li><?php endif; endforeach; endif; ?>          
	</ol>
</div>
  <section class="content">



<div class="panel panel-default">

            <form id='form1' name='myform' class="navbar-form form-inline" enctype="multipart/form-data">



 
 





   <div class="panel-heading">

              <div class="form-group">
                <input id='title' type="text" name="title" class="form-control" placeholder="请输入工单标题" id="rangetime" style="width:300px;">
              </div>

              <div class="form-group">
                <select id='level' name="rank" class="form-control" style="width:200px;">
                  <option value="1">紧急</option>
                  <option value="2">高</option>
                  <option value="3">一般</option>
                  <option value="4">低</option>
                </select>

              </div>
              <div class="form-group">
                <select id='leibie' name="leibie" class="form-control" style="width:200px;">
                  <option value="1">查询</option>
                  <option value="2">需求</option>
                  <option value="3">管理</option>
                  
                </select>

              </div>
</div>


    <div class="panel-body">
              <script type="text/plain" name='content' id="myEditor" style="width:100%;height:200px;"></script>






        <div id='quanshangchuan'> 
        <!--外层容器-->


    <div id="upBox">
       <div id="inputBox" class="btn btn-primary"><input type="file" title="请选择图片" id="file" multiple />点击选择图片</div>
       <input type='hidden' class="imgid" id='imgid' name="imgid" value=''>
         <div id="imgBox">
         </div>
         <input  type="button" id="btn" value="上传图片" class="btn btn-primary" style="display: none;margin-top: 10px;width: 20%;"></br>
         </div>



    <div id="upfBox">
       <div id="inputfBox" class="btn btn-primary"><input type="file" title="请选择文件" id="filef" multiple />点击选择文件</div>

       <input type='hidden' class="fileid" id='fileid'  name="fileid" value=''>


         <div id="imgfBox">

         </div>


         <input type="button" id="btnf" value="上传文件" class="btn btn-primary" style="display: none;margin-top: 10px;width: 20%;"></br>
         </div>


</div>




             <div align="center"> <input  type="button" id="new" class="btn btn-primary" value="  新建工单  "></div>


              </div>

            </form>
   

</div>

<script src='/Public/uploadImg/uploadImg.js' type="text/javascript"></script>
<script src='/Public/uploadImg/uploadFile.js' type="text/javascript"></script>
<script src='/Public/js/workorder/newwork.js' type="text/javascript"></script>
</section>
</div>
<script>
  var SCOPE = {
    'save_url' : '/index.php/Home/Workorder/newwork',
    'jump_url' : '/index.php/Home/Workorder/allwork',
    'ajax_upload_image_url' : '/index.php/Home/Workorder/uploadify',
    //'ajax_upload_swf' : '/Public/js/party/uploadify.swf',*/
  };
   imgUpload({
        inputId:'file', //input框id
        imgBox:'imgBox', //图片容器id
        buttonId:'btn', //提交按钮id
        upUrl:'/index.php/home/img/ajaxuploadimg',  //提交地址
        data:'file1' //参数名
      });

   fileUpload({
        inputId:'filef', //input框id
        imgfBox:'imgfBox', //图片容器id
        buttonId:'btnf', //提交按钮id
        upUrl:'/index.php/home/file/ajaxuploadfile',  //提交地址
        data:'file1f' //参数名
      });

</script>
<script type="text/javascript">

</script>
</body>
</html>