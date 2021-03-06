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
   <div class="row">
    <div class="col-xs-12">
      <div class="box">

       <!-- /.box-header -->
       <div class="box-body">              
        <div class="row">
          <div class="col-sm-12">
       
<?php if(empty($list) == true): ?><div style="text-align: center;"><strong>暂时没有工单</strong></div>
           <?php else: ?>
              <input id='mybtn' class="btn btn-primary" type='button' value="删除选中工单" <?php if($rid == 6): ?>style='display: none;'<?php endif; ?>>
            <table id="list-table" class="table table-striped singcms-table" role="grid" aria-describedby="example1_info" style="text-align: center;">
             <thead>
               <tr role="row" align="center">
                 <td width="3%" <?php if($rid == 6): ?>style='display: none;'<?php endif; ?>><b>全选</b><input id='allselect' type="checkbox"  onclick="checkAll()"></td>
                 <td width="3%"><b>状态</b></td>
                 <td width="8%"><b>标题</b></td>
                 <td width="8%"><b>级别</b></td>
                 <td width="8%"><b>创建时间</b></td>
                 <td width="15%"><b>操作</b></td>

               </tr>
             </thead>


             <tbody>
             
              <?php if(is_array($list)): foreach($list as $k=>$vo): ?><tr role="row">
                  <td <?php if($rid == 6): ?>style='display: none;'<?php endif; ?>><input type="checkbox" value='<?php echo ($vo["id"]); ?>' name = 'dcheckbox'></td>
                  
                  <td>
                <div <?php if($vo['status'] == 1): ?>class="label label-danger"
                   <?php elseif($vo['status'] == 2): ?> class="label label-warning"
                   <?php elseif($vo['status'] == 3): ?> class="label label-info"
                   <?php elseif($vo['status'] == 4): ?> class="label label-success"<?php endif; ?>> <?php if($vo['status'] == 1): ?>未处理
                   <?php elseif($vo['status'] == 2): ?>处理中
                   <?php elseif($vo['status'] == 3): ?>待回复
                   <?php elseif($vo['status'] == 4): ?>已完成<?php endif; ?>
                 </div>
               </td>
               <td><?php echo ($vo["title"]); ?></td>
               <td>
                 <?php if($vo['rank'] == 1): ?><p class="label label-danger">紧急</p>
                   <?php elseif($vo['rank'] == 2): ?><p class="label label-warning">高</p>
                   <?php elseif($vo['rank'] == 3): ?><p class="label label-info">一般</p>
                   <?php else: ?><p class="label label-success">低</p><?php endif; ?>
               </td>
               <td><?php echo ($vo["create_time"]); ?></td>
               <td>
               <input type="hidden" name="wid"  value="<?php echo ($vo["id"]); ?>">
               <input type='button'  class="btn btn-primary"  attr-id='<?php echo ($vo["id"]); ?>' id='checkone' name='check'  value="查询">

               </td>
             </tr><?php endforeach; endif; ?>
 
           </tbody>

           </table><?php endif; ?>
           <ul class="pagination"><?php echo ($pageRes); ?></ul>
         </section>

       </div>

     </body>
          <script src='/Public/js/workorder/allwork.js' type="text/javascript"></script>
     <script type="text/javascript">
      var SCOPE = {
        'save_url' : '/Home/Workorder/allwork',
        'edit_url' : '/index.php?m=Home&c=OneWork&a=checkcontent',
        'jump_url' : '/Home/Mywork/waittingreply',
      };
    </script>
   
    </html>