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
  <style>
 #wrapper{
    position: relative;
    width:200px;
    height:100px;
    border:1px solid darkgray;
    float: right;
}
#progressbar{
    position: absolute;
    top:50%;
    left:50%;
    margin-left:-90px;
    margin-top:-10px;
    width:180px;
    height:20px;
    border:1px solid darkgray;

}
/*在进度条元素上调用动画*/
#fill{
    animation: move 2s;
    text-align: center;
    background-color: #6caf00;
}
/*实现元素宽度的过渡动画效果*/
@keyframes move {
    0%{
        width:0;

    }
    100%{
        width:100%;
    }
}
  </style>
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
     <select id='status' name="status" class="form-control" style="width:200px;">
                  <option <?php if($onelist['status'] == 1): ?>selected="selected"<?php endif; ?> value="1">将工单转至未处理</option>
                  <option <?php if($onelist['status'] == 2): ?>selected="selected"<?php endif; ?>   value="2">将工单转至正在处理</option>
                  <option  <?php if($onelist['status'] == 3): ?>selected="selected"<?php endif; ?> value="3">将工单转至等待回复</option>
                  <option  <?php if($onelist['status'] == 4): ?>selected="selected"<?php endif; ?>  value="4">将工单转至已处理</option>
                </select>
     <select id='rank' name="rank" class="form-control" style="width:200px;">
                  <option <?php if($onelist['rank'] == 1): ?>selected="selected"<?php endif; ?>   value="1">紧急</option>
                  <option <?php if($onelist['rank'] == 2): ?>selected="selected"<?php endif; ?> value="2">高</option>
                  <option  <?php if($onelist['rank'] == 3): ?>selected="selected"<?php endif; ?> value="3">一般</option>
                  <option  <?php if($onelist['rank'] == 4): ?>selected="selected"<?php endif; ?> value="4">低</option>
                </select>
                <input type="button"  class="btn btn-primary" id='setsr' value='提交'>
<input type="hidden" id="getid" value="<?php echo ($gid); ?>">



            

<div>
            <p 
             <?php if($onelist['status'] == 1): ?>class="label label-danger"
             <?php elseif($onelist['status'] == 2): ?>class="label label-warning"
             <?php elseif($onelist['status'] == 3): ?>class="label label-info"
             <?php elseif($onelist['status'] == 4): ?>class="label label-success"<?php endif; ?>

            ><?php if($onelist['status'] == 1): ?>未处理
             <?php elseif($onelist['status'] == 2): ?>处理中
             <?php elseif($onelist['status'] == 3): ?>待回复
             <?php elseif($onelist['status'] == 4): ?>已完成<?php endif; ?>
         </p>&nbsp&nbsp&nbsp&nbsp&nbsp

        <p 
     <?php if($onelist['rank'] == 1): ?>class="label label-danger"
             <?php elseif($onelist['rank'] == 2): ?>class="label label-warning"
             <?php elseif($onelist['rank'] == 3): ?>class="label label-info"
             <?php elseif($onelist['rank'] == 4): ?>class="label label-success"<?php endif; ?>


         ><?php if($onelist['rank'] == 1): ?>紧急
           <?php elseif($onelist['rank'] == 2): ?>高
           <?php elseif($onelist['rank'] == 3): ?>一般
           <?php else: ?>低<?php endif; ?></p>
</div>

 

<div class = "panel panel-primary" style="margin-top: 50px">
<div class="panel-heading"> <h3 class="panel-title"><?php echo ($onelist['title']); ?></h3></div>
<div class="panel-body">
<p><?php echo ($onelist["content"]); ?>
</p>
</div>
<ul class="list-group">
        <li class="list-group-item" <?php if($il == 0): ?>style="display: none;"<?php endif; ?>> 
        <?php if(is_array($imgarr)): $i = 0; $__LIST__ = $imgarr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><img class="img-rounded" src='/upload/images/<?php echo ($vo); ?>' style="width: 100px;height: 100px;" onclick="imgDisplay(this)"><?php endforeach; endif; else: echo "" ;endif; ?>
        </li>
        <li class="list-group-item" <?php if($fl == 0): ?>style="display: none;"<?php endif; ?>>
           <?php if(is_array($filearr)): $i = 0; $__LIST__ = $filearr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><div>
          <a href='/upload/files/<?php echo ($vo2["file_url"]); ?>'  >
          <?php echo ($vo2["file_name"]); ?>
          </a><span> <a href='/upload/files/<?php echo ($vo2["file_url"]); ?>'  >
          下载
          </a></span>
          <div><?php endforeach; endif; else: echo "" ;endif; ?>
        </li>
    </ul>
</div>







        <div class = "panel panel-primary">
        <div class="panel-heading">
         <h3 class="panel-title">
            工单回复
        </h3>
        </div>

        <?php if($le == 0): ?><p style="text-align: center;"><strong>暂时没有回复内容</strong></p><?php endif; ?>

           <div class="panel-body">

        <?php if(is_array($sa)): $i = 0; $__LIST__ = $sa;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vosa): $mod = ($i % 2 );++$i;?><div class = "panel panel-default">


          <div class="panel-heading">用户名:<?php echo ($vosa["user"]); ?>&nbsp&nbsp&nbsp 时间:<?php echo ($vosa["time"]); ?></div>
          
          <div class="panel-body">
         <p> <?php echo ($vosa["content"]); ?>
          
   </p>
          </div>
          <ul class="list-group">

          <li class="list-group-item" <?php if($vosa['img_url'] == false): ?>style="display: none;"<?php endif; ?>>
      <?php if(is_array($vosa['img_url'])): $i = 0; $__LIST__ = $vosa['img_url'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lyvo): $mod = ($i % 2 );++$i;?><img class="img-rounded"  src='/upload/images/<?php echo ($lyvo); ?>' style="width: 100px;height: 100px;" onclick="imgDisplay(this)" ><?php endforeach; endif; else: echo "" ;endif; ?>

          </li> 
           <li class="list-group-item" <?php if($vosa['file_url'] == false): ?>style="display: none;"<?php endif; ?>>
   <?php if(is_array($vosa['file_url'])): $k = 0; $__LIST__ = $vosa['file_url'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lyvo2): $mod = ($k % 2 );++$k;?><div> <a href='/upload/files/<?php echo ($lyvo2["url"]); ?>' download="<?php echo ($lyvo2["name"]); ?>" ><?php echo ($lyvo2["name"]); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
           </li> 
          </ul>


 

        </div><?php endforeach; endif; else: echo "" ;endif; ?>




<ul class="pagination">
                           <?php echo ($page); ?>
                        </ul>
</div>
        </div>



        <form> 
          <script type="text/plain" name='content' id="myEditor" style="width:100%;height:200px;"></script>

   <div id='quanshangchuan'>      
    <div id="upBox">
       <div id="inputBox" class="btn btn-primary"><input type="file" title="请选择图片" id="file" multiple />点击选择图片</div>
       <input type='hidden' class="imgid" id='imgid'  name="imgid" value=''>
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

        </form>

      </div>
    </div>
    <input type="button" id='btnl' class="btn btn-primary"  value="发送">
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
      var SCOPE = {
        'save_url' : '/index.php/Home?c=OneWork&a=checkcontent',
        'edit_url' : '/index.php/Home?c=OneWork&a=checkcontent',
      };
    </script>
<script type="text/javascript">
  var um = UM.getEditor('myEditor');


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


$('#btnl').click(function(){
  var gid = document.getElementById('getid').value;
  var imgid = document.getElementById('imgid').value;
  var fileid = document.getElementById('fileid').value;
  var liuyancontent =  um.getContent();
  if(!liuyancontent){
    dialog.error('内容不能为空');
    return;
  }
  var data =new FormData();
  data.append('content',liuyancontent);
  data.append('id',gid);
  data.append('imgid',imgid);
  data.append('fileid',fileid);
  var url = SCOPE.save_url;
  var jumpurl = SCOPE.edit_url+'&id='+gid;
  $.ajax({
      type: "POST",
      cache: false,
      processData: false,
      contentType: false,
      async: false,
      url:url,
      data: data,
          success: function(dat) {
          
          return dialog.success('留言成功',jumpurl);
      },
      error:function(dat){
   return dialog.error('上传失败，系统内部错误');
      }
  });
});




$('#setsr').click(function(){
  var gid = document.getElementById('getid').value;

    var status = document.getElementById('status');
var index=status.selectedIndex ;         
 var reallevel = status.options[index].value;

    var rank = document.getElementById('rank');
var index1=rank.selectedIndex ;         
 var realrank= rank.options[index1].value;


 var data =new FormData();
 data.append('status',reallevel);
 data.append('rank',realrank);
 data.append('id',gid);
 url = SCOPE.save_url;
 var jumpurl = SCOPE.edit_url+'&id='+gid;
  $.ajax({
      type: "POST",
      cache: false,
      processData: false,
      contentType: false,
      async: false,
      url:url,
      data: data,
          success: function(dat) {
            console.log(dat);
 return dialog.success('设置成功',jumpurl);
      },
      error:function(dat){
   return dialog.error('设置失败，系统内部错误');
      }
  });
});




//图片灯箱
function imgDisplay(obj) {
  var src = $(obj).attr("src");
  var imgHtml = '<div style="width: 100%;height: 100vh;overflow: auto;background: rgba(0,0,0,0.5);text-align: center;position: fixed;top: 0;left: 0;z-index: 1000;"><img src=' + src + ' style="margin-top: 100px;width: 70%;margin-bottom: 100px;"/><p style="font-size: 50px;position: fixed;top: 30px;right: 30px;color: white;cursor: pointer;" onclick="closePicture(this)">×</p></div>'
  $('body').append(imgHtml);
}
//关闭
function closePicture(obj) {
  $(obj).parent("div").remove();
}

</script>
</html>