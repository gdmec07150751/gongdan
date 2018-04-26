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
    <link href="/Public/css/checkone.css" rel="stylesheet" type="text/css"/> 
    
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
 

<style type="text/css">
.layui-laydate-main {
    width: 100%;
}
.layui-laydate-content td, .layui-laydate-content th {
    height: 10%;
    font-size: 270%;
    padding-left: 45px;
    padding-right: 45px;
}
</style>
<div class="wrapper">
    <div class="breadcrumbs" id="breadcrumbs">
	<ol class="breadcrumb">
	<?php if(is_array($nav_list)): foreach($nav_list as $k=>$v): if($k == '首页'): ?><li><a href="<?php echo ($v); ?>"><i class="fa fa-home"></i>&nbsp;&nbsp;<?php echo ($k); ?></a></li>
	    <?php else: ?>    
	        <li><a href="<?php echo ($v); ?>"><?php echo ($k); ?></a></li><?php endif; endforeach; endif; ?>          
	</ol>
</div>
    <section class="content" style="width: 100%;height: 100%;">
      <div id="calendar" style="text-align: center;"></div>
    </section>
</div>
<script type="text/javascript">
layer.config({
  extend: 'extend/layer.ext.js'
});   
var info = <?php echo ($info); ?>;
laydate.render({
  elem: '#calendar'
  ,theme: 'grid'
  ,position: 'static'
  ,mark: info
  ,change: function(value, date){
    var now_time = value;
    $.ajax({
      type : 'post',
      async : false,
      url : "<?php echo U('Home/Work/ajaxwork');?>",
      data : {time:value},
      dataType : 'json',
      success : function(data,value){
        console.log(data);
        if(data){
          layer.prompt({title: data.title+'工作内容', formType: 2,value: data.content,maxlength: 200}, function(con, index){
          layer.close(index);
          layer.prompt({title: data.title+'工作计划', formType: 2,value: data.plan,maxlength: 200}, function(plan, index){
          layer.close(index);
            $.ajax({
            type : 'post',
            async : false,
            url : "<?php echo U('Home/Work/ajaxhandlework');?>",
            data : {times:data.times,title:data.title,field:data.field,con:con,plan:plan},
            dataType : 'json',
            success : function(rel){
              if(rel.status==1){
                layer.alert(rel.msg, {icon: 1});
                window.location.href = "<?php echo U('Home/Work/worklog');?>";
              }
              else layer.alert(rel.msg, {icon: 2});
              
            }
            });
          });
        });
        }
      }
    })
  }
});
</script>
</body>
</html>