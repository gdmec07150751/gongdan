<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
  <link href="/Public/js/uploadify/uploadify.css" rel="stylesheet" type="text/css"  />  
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
  <script type="text/javascript" src="/Public/js/uploadify/jquery.uploadify.min.js"></script>  

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
   <div class="row">
    <div class="col-xs-12">
      <div class="box">

       <!-- /.box-header -->
       <div class="box-body">              
        <div class="row">
          <div class="col-sm-12"> 


            <div>标题:<?php echo ($onelist['title']); ?></div>


            <div>工单状态:<?php if($onelist['status'] == 1): ?>未处理
             <?php elseif($onelist['status'] == 2): ?>处理中
             <?php elseif($onelist['status'] == 3): ?>待回复
             <?php elseif($onelist['status'] == 4): ?>已完成<?php endif; ?>
         </div>


         <div>级别:<?php if($onelist['rank'] == 1): ?>紧急
           <?php elseif($onelist['rank'] == 2): ?>高
           <?php elseif($onelist['rank'] == 3): ?>一般
           <?php else: ?>低<?php endif; ?></div>


         <div>内容:<?php echo ($onelist["content"]); ?></div>

         <?php if(is_array($imgarr)): $i = 0; $__LIST__ = $imgarr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div><img src='/upload/images/<?php echo ($vo); ?>' style="width: 100px;height: 100px;"></div><?php endforeach; endif; else: echo "" ;endif; ?>
        <?php if(is_array($filearr)): $i = 0; $__LIST__ = $filearr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><div><a href='/upload/files/<?php echo ($vo2); ?>' >下载附件</a></div><?php endforeach; endif; else: echo "" ;endif; ?>


        <div>留言板位置</div>



        <form> 
          <script type="text/plain" name='content' id="myEditor" style="width:100%;height:200px;"></script>

   <div id='quanshangchuan'>      
    <div id="upBox">
       <div id="inputBox"><input type="file" title="请选择图片" id="file" multiple />点击选择图片</div>
       <input type='hidden' class="imageval"  name="imageval" value=''>
         <div id="imgBox">
         </div>
         <input type="button" id="btn" value="上传图片"></br>
         </div>
    <div id="upfBox">
       <div id="inputfBox"><input type="file" title="请选择文件" id="filef" multiple />点击选择文件</div>
       <input type='hidden' class="fileval"  name="fileval" value=''>
       <input type='hidden' class="filename"  name="filename" value=''>
         <div id="imgfBox">
         </div>
         <input type="button" id="btnf" value="上传文件"></br>
         </div>
</div>


             <select id='level' name="rank" class="form-control" style="width:200px;">
                  <option value="1">将工单转至未处理</option>
                  <option value="2">将工单转至正在处理</option>
                  <option value="3">将工单转至等待回复</option>
                  <option value="4">将工单转至已处理</option>
                </select>
          <input type="button" id='btn' value="发送">
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</section>
</div>
</body>

<script src='/Public/uploadImg/uploadImg.js' type="text/javascript"></script>
<script src='/Public/uploadImg/uploadFile.js' type="text/javascript"></script>
<script type="text/javascript">
  var um = UM.getEditor('myEditor');


     imgUpload({
        inputId:'file', //input框id
        imgBox:'imgBox', //图片容器id
        buttonId:'btn', //提交按钮id
        upUrl:'/index.php/home/ajaxupload/ajaxuploadimg',  //提交地址
        data:'file1' //参数名
      });

   fileUpload({
        inputId:'filef', //input框id
        imgfBox:'imgfBox', //图片容器id
        buttonId:'btnf', //提交按钮id
        upUrl:'/index.php/home/ajaxupload/ajaxuploadfile',  //提交地址
        data:'file1f' //参数名
      });


$('#btn').click(function(){


});

</script>
</html>