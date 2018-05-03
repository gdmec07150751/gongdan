<?php if (!defined('THINK_PATH')) exit();?>    <!DOCTYPE html>
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
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">编辑任务</h3>
                            </div>
                            <!-- /.box-header -->
                            <form action="<?php echo U('Work/handletask');?>" method="post" class="form-horizontal" id="taskform">
                            <div class="box-body">                         
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">任务名称</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" style="width:200px" name="title" value="<?php echo ($info["title"]); ?>">
                                        </div>
                                        <div class="col-sm-4"><span class="help-inline text-warning"></span></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">任务内容</label>
                                        <div class="col-sm-4">
                                            <textarea name="content" rows="10" cols="60" id="content"><?php echo ($info["content"]); ?></textarea>
                                        </div>
                                      
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">分配人员</label>

                                        <div class="col-sm-8">
                                            <select class="small form-control"  style="width:200px" name="user_name" id="user_name">
                                                <option value="">人员</option>
                                                <?php if(is_array($userlist)): foreach($userlist as $key=>$vo): ?><option value="<?php echo ($vo["name"]); ?>" <?php if($vo[name] == $info['user_name']): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>        
    										</select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">截止时间</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" style="width:200px" name="expected_time" id="expecttime" value="<?php echo (date("Y-m-d H:i:s",$info[expected_time])); ?>">
                                        </div>
                                        <div class="col-sm-4"><span class="help-inline text-warning"></span></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">任务状态</label>
                                        
                                        <div class="col-sm-8">
                                            <label> <input type="radio" name="status" <?php if($info[status] == 0): ?>checked<?php endif; ?> value="0">未解决</label>
                                            <label> <input type="radio" name="status" <?php if($info[status] == 1): ?>checked<?php endif; ?> value="1">正在解决</label>
                                            <label> <input type="radio" name="status" <?php if($info[status] == 2): ?>checked<?php endif; ?> value="2">已解决</label>
                                        </div>
                                    </div>
                                

                            </div>
                            <div class="box-footer">
                            	<input type="hidden" name="act" value="<?php echo ($act); ?>">
                                <input type="hidden" name="taskid" value="<?php echo ($_GET['id']); ?>">
                            	<button type="reset" class="btn btn-primary"><i class="icon-ok"></i>重填  </button>                       	                 
                                <button type="button" class="btn btn-primary pull-right" onclick="checkform()"><i class="icon-ok"></i>提交</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
    </div> 
    <script type="text/javascript">
    laydate.render({
      elem: '#expecttime'
      ,theme: '#393D49'
      ,type: 'datetime'
    });

    function checkform(){
        var title = $("input[name='title']").val();
        var content = $("#content").val();
        var username = $("#user_name").val();
        var expecttime = $("#expecttime").val();
        var time0 = Date.parse(new Date(expecttime))/1000;
        var time1 = Date.parse(new Date())/1000;
        if(title==''){layer.alert('任务名称不能为空！');return;}
        if(content==''){layer.alert('任务内容不能为空！');return;}
        if(expecttime==''){layer.alert('截止时间不能为空！');return;}
        if(time0-time1<0){layer.alert('截止时间大于当前时间！');return;}
        $("#taskform").submit();
    }
    </script> 
    </body>
    </html>