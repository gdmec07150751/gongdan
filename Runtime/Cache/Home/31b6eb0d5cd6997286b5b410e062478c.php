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
                  <table id="list-table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="text-align: center;">
                     <thead>
                       <tr role="row" align="center">
                         <td width="8%"><b>任务id</b></td>
                         <td width="8%"><b>完成人</b></td>
                         <td width="15%"><b>任务名称</b></td>
                         <td><b>任务情况</b></td>
                         <td width="8%"><b>任务状态</b></td>
                         <td width="4%"><b>操作</b></td>
                       </tr>
                     </thead>
            <tbody>
              <?php if(is_array($list)): foreach($list as $k=>$vo): ?><tr role="row">
                         <td><?php echo ($vo["id"]); ?></td>
                         <td><?php echo ($vo["user_name"]); ?></td>
                         <td><a href="javascript:;" onclick="showall('<?php echo ($vo["title"]); ?>','任务名称')"><?php echo (getsubstr($vo["title"],0,9)); ?></a></td>
                         <td>
<?php if($vo["width"] > 90): ?><div class="progress" onclick="showtime(<?php echo ($vo["create_time"]); ?>,<?php echo ($vo["expected_time"]); ?>,'st<?php echo ($vo["id"]); ?>')" id='st<?php echo ($vo["id"]); ?>'>
    <div class="progress-bar progress-bar-danger" role="progressbar"
         aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
         style="width: <?php echo ($vo['width']); ?>%;">
        <span class="sr-only"></span>
    </div>
</div>
<?php elseif($vo["width"] <= 90 and $vo["width"] > 60): ?>
<div class="progress" onclick="showtime(<?php echo ($vo["create_time"]); ?>,<?php echo ($vo["expected_time"]); ?>,'st<?php echo ($vo["id"]); ?>')" id='st<?php echo ($vo["id"]); ?>'>
    <div class="progress-bar progress-bar-warning" role="progressbar"
         aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
         style="width: <?php echo ($vo['width']); ?>%;">
        <span class="sr-only"></span>
    </div>
</div>
<?php elseif($vo["width"] <= 60 and $vo["width"] > 20): ?>
<div class="progress" onclick="showtime(<?php echo ($vo["create_time"]); ?>,<?php echo ($vo["expected_time"]); ?>,'st<?php echo ($vo["id"]); ?>')" id='st<?php echo ($vo["id"]); ?>'>
    <div class="progress-bar progress-bar-info" role="progressbar"
         aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
         style="width: <?php echo ($vo['width']); ?>%;">
        <span class="sr-only"></span>
    </div>
</div>
<?php else: ?>
<div class="progress" onclick="showtime(<?php echo ($vo["create_time"]); ?>,<?php echo ($vo["expected_time"]); ?>,'st<?php echo ($vo["id"]); ?>')" id='st<?php echo ($vo["id"]); ?>'>
    <div class="progress-bar progress-bar-success" role="progressbar"
         aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
         style="width: <?php echo ($vo['width']); ?>%;">
        <span class="sr-only"></span>
    </div>
</div><?php endif; ?>
                         </td> 
                         <td><?php echo ($vo["_status"]); ?></td>        
                         <td>
                          <a class="btn btn-primary" href="javascript:;" onclick="updatestatus(<?php echo ($vo['id']); ?>)"><i class="fa fa-pencil"></i></a>
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
function updatestatus(id){
    layer.open({
        content: '修改任务状态',
        title: '',
        btn: ['未解决', '正在解决', '已解决'],
        yes: function(index, layero) {
            ajaxsub(0,id);
            layer.closeAll();
            window.location.href = "<?php echo U('Home/Work/status');?>"; 
         
        },
        btn2: function(index, layero) {
            ajaxsub(1,id);
            layer.closeAll();
            window.location.href = "<?php echo U('Home/Work/status');?>";
           
        },
        btn3: function(index, layero) {
            ajaxsub(2,id);
            layer.closeAll();
            window.location.href = "<?php echo U('Home/Work/status');?>";
            
        },
        cancel: function() {
            layer.closeAll();
        }
    });
}
function ajaxsub(status,id){
    $.ajax({
        type:'POST',
        url:"<?php echo U('Work/updatestatus');?>",
        data:{status:status,id:id},
        dataType:'json',
        success:function(data){
            layer.msg(data.msg, {icon: 1});                
        }
    });
}
function showtime(t1,t2,id){
  var msg = '任务创建时间为'+getLocalTime(t1)+',截止时间为'+getLocalTime(t2);
  layer.tips(msg, '#'+id, {
    tips: [1, '#0FA6D8'],
    time: 3500
  });
}
function getLocalTime(nS) {     
   return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');     
}  
function showall(info,title){
  layer.alert(info,{title:title});
}


</script>
</body>
</html>