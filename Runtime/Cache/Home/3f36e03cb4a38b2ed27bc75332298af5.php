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
              <div class="box-header">
                  <nav class="navbar navbar-default">      
                <div class="collapse navbar-collapse">
                  <form class="navbar-form form-inline" action="<?php echo U('Info/index');?>" method="post">
                    <div class="form-group">
                        <input type="text" name="rangetime" class="form-control" placeholder="时间" id="rangetime" value="<?php echo ($time); ?>">
                    </div>
   
                    <button type="submit" class="btn btn-default">搜索</button>
                    <div class="form-group pull-right">
                      <a href="<?php echo U('Work/handletask');?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>新增任务</a>
                    </div>      
                  </form>   
                </div>
            </nav>               
               </div>     
               <!-- /.box-header -->
               <div class="box-body">              
                <div class="row">
                <div class="col-sm-12">
                  <table id="list-table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="text-align: center;">
                     <thead>
                       <tr role="row" align="center">
                         <td width="4%"><b>ID</b></td>
                         <td width="8%"><b>是否阅读</b></td>
                         <td><b>信息</b></td>
                         <td width="15%"><b>发送人</b></td>
                         <td width="15%"><b>发送时间</b></td>
                         <td width="4%"><b>操作</b></td>
                       </tr>
                     </thead>
            <tbody>
              <?php if(is_array($list)): foreach($list as $k=>$vo): ?><tr role="row" onclick="read(<?php echo ($vo["id"]); ?>,<?php echo ($vo["type"]); ?>)">
                         <td><?php echo ($vo["id"]); ?></td>
                         <td>
<img width="20" height="20" src="/Public/images/<?php if($vo[is_read] == 1): ?>1.png<?php else: ?>0.png<?php endif; ?>"/>
                         </td>
                         <td><?php echo ($vo["msg"]); ?></td>
                  
                         <td><?php echo ($userlist[$vo['from']]); ?></td>
              
                         <td><?php echo (date("Y-m-d H:i:s",$vo["addtime"])); ?></td>
                         <td>

                          <a class="btn btn-danger" href="javascript:void(0)" data-url="<?php echo U('Work/handletask');?>" data-id="<?php echo ($vo["id"]); ?>" onclick="delfun(this)"><i class="fa fa-trash-o"></i></a>   
                        </td>
                        </tr><?php endforeach; endif; ?>
                       </tbody>
                     <tfoot>
                     
                     </tfoot>
                   </table>
                 </div>
            </div>
              <div class="row">
                    <div class="col-sm-6 text-left"></div>
                    <div class="col-sm-6 text-right"><?php echo ($page); ?></div>    
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div>
       </div>
   </section>
</div>
<script>
laydate.render({
  elem: '#rangetime'
  ,range: '~'
});

function showall(info,title){
  layer.alert(info,{title:title});
}
function read(id,type){
    $.ajax({
        type:'POST',
        url:"<?php echo U('Info/updateread');?>",
        data:{id:id},
        dataType:'json',
        success:function(data){
          if(type==2)window.location.href = "<?php echo U('Home/Work/status');?>";  
          else window.location.href = "<?php echo U('Home/Info/index');?>";             
        }
    }); 
}
</script>
</body>
</html>