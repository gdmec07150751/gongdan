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
                                <h3 class="box-title"></h3>
                            </div>

                            <!-- /.box-header -->
                            <form action="<?php echo U('Manager/userhandle');?>" method="post" class="form-horizontal" id="taskform">
                            <div class="box-body">                         
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">用户名</label>


                                    <?php if($info["name"] != null): ?><div class="col-sm-4">
                                            <p style="margin-top: 6px;" name="name" value="<?php echo ($info["name"]); ?>"><?php echo ($info["name"]); ?></p>
                                        </div>

                                        <?php else: ?>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" style="width:200px;" name="name" value="">
                                        </div><?php endif; ?>



                                        <div class="col-sm-4"><span class="help-inline text-warning"></span></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">登录名</label>


                                      <?php if($info["emp_no"] != null): ?><div class="col-sm-4">
                                            <p style="margin-top: 6px;"  name="emp_no" value="<?php echo ($info["emp_no"]); ?>"><?php echo ($info["emp_no"]); ?></p>
                                        </div>
                                      <?php else: ?>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" style="width:200px;"  name="emp_no" value="">
                                        </div><?php endif; ?>

                                        <div class="col-sm-4"><span class="help-inline text-warning"></span></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">登录密码</label>
                                        <div class="col-sm-4">
                                            <input type="password" class="form-control" style="width:200px" name="password" value="<?php echo ($info["password"]); ?>">
                                        </div>
                                        <div class="col-sm-4"><span class="help-inline text-warning"></span></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" <?php if($sid == 6): ?>style="display: none;"<?php endif; ?>>所属角色</label>

                      <!--                  <?php if($vo['role_id'] == 6): ?><input type='hidden' value="6" tyle="width:200px" name="role_id" id="role_id">
                                       <?php else: ?>
                                       <input type='hidden' value="2" tyle="width:200px" name="role_id" id="role_id"><?php endif; ?> -->


                                        <div class="col-sm-8" <?php if($sid == 6): ?>style="display: none;"<?php endif; ?>>
                                            <select class="small form-control"  style="width:200px" name="role_id" id="role_id">
                                                <option value="">请选择</option>
                                                <?php if(is_array($role)): foreach($role as $key=>$vo): ?><option value="<?php echo ($vo["role_id"]); ?>" <?php if($vo['role_id'] == $info['role_id']): ?>selected<?php endif; ?>><?php echo ($vo["role_name"]); ?></option><?php endforeach; endif; ?>        
    										</select>
                                        </div>
                                    </div>                               

                            </div>
                            <div class="box-footer">
                            	<input type="hidden" name="act" value="<?php echo ($act); ?>">
                                <input type="hidden" name="uid" value="<?php echo ($_GET['user_id']); ?>">
                            	<button type="reset" class="btn btn-primary"><i class="icon-ok"></i>重填  </button>                       	                 
                                <button type="submit" class="btn btn-primary pull-right"><i class="icon-ok"></i>提交</button>
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

    </script> 
    </body>
    </html>