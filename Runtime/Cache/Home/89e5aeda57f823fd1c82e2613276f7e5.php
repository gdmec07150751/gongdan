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
                  <form class="navbar-form form-inline" action="<?php echo U('Work/worklist');?>" method="post">
                    <div class="form-group">
                        <input type="text" name="rangetime" class="form-control" placeholder="时间" id="rangetime" value="<?php echo ($time); ?>">
                    </div>
                    <div class="form-group">
                        <select name="username" class="form-control" style="width:200px;">
                          <option value="">选择姓名</option>
                          <?php if(is_array($userlist)): foreach($userlist as $key=>$vo): ?><option value="<?php echo ($vo["name"]); ?>" <?php if($vo[name] == $username): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
                        </select>
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
                         <td width="15%"><b>任务名称</b></td>
                         <td><b>任务详情</b></td>
                         <td width="10%"><b>任务完成人</b></td>
                         <td width="10%"><b>任务状态</b></td>
                         <td width="14%"><b>任务截止时间</b></td>
                         <td width="14%"><b>发布时间</b></td>
                         <?php if($userid < 3): ?><td width="9%"><b>操作</b></td><?php endif; ?>
                       </tr>
                       </tr>
                     </thead>
            <tbody>
              <?php if(is_array($list)): foreach($list as $k=>$vo): ?><tr role="row">
                         <td><?php echo ($vo["id"]); ?></td>
                         
                         <td><a href="javascript:;" onclick="showall('<?php echo ($vo["title"]); ?>','任务名称')"><?php echo (getsubstr($vo["title"],0,10)); ?></a></td>
                         <td><a href="javascript:;" onclick="showall('<?php echo ($vo["content"]); ?>','任务详情')"><?php echo (getsubstr($vo["content"],0,10)); ?></a></td>
                         <td><?php echo ($vo["user_name"]); ?></td>
                         <td><?php echo ($vo["_status"]); ?></td>
                         <td><?php echo (date("Y-m-d H:i:s",$vo["expected_time"])); ?></td>
                         <td><?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></td>
                         <?php if($userid < 3): ?><td>

                          <a class="btn btn-danger" href="javascript:void(0)" data-url="<?php echo U('Work/handletask');?>" data-id="<?php echo ($vo["id"]); ?>" onclick="delfun(this)"><i class="fa fa-trash-o"></i></a>
                          <a class="btn btn-primary" href="<?php echo U('Work/handletask',array('id'=>$vo['id']));?>"><i class="fa fa-pencil"></i></a>
                          </td><?php endif; ?>
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


 
function updatetime(){
laydate.render({
  elem: '#updatetime'
  ,range: '~'
});
}

</script>
</body>
</html>