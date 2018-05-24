/*var rid =document.getElementById('rid').value;
if(rid==6){
  var dealwork =document.getElementById('dealwork');
  dealwork.style.display='none';
}*/
//实例化百度编辑器
  var um = UM.getEditor('myEditor',{initialFrameWidth: null});

  //var um = UM.getEditor('myEditor');

//图片处理
     imgUpload({
        inputId:'file', //input框id
        imgBox:'imgBox', //图片容器id
        buttonId:'btn', //提交按钮id
        upUrl:'/home/img/ajaxuploadimg',  //提交地址
        data:'file1' //参数名
      });
//文件处理
   fileUpload({
        inputId:'filef', //input框id
        imgfBox:'imgfBox', //图片容器id
        buttonId:'btnf', //提交按钮id
        upUrl:'/home/file/ajaxuploadfile',  //提交地址
        data:'file1f' //参数名
      });



//取消处理按钮
$('#csw').click(function(){
layer.confirm('您确定要取消处理这个工单？', {
mybtn: ['确定','取消'] //按钮
},function(){
  var url =SCOPE.save_url;
var status = document.getElementById('status').value;
//工单ID
var gid = document.getElementById('getid').value;
//处理人的ID
var sid = document.getElementById('sid').value;
status = 1;
var data = new FormData();
data.append('status',status);
 data.append('id',gid);
  data.append('sid',sid);
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
 return dialog.success('取消成功',jumpurl);
      },
      error:function(dat){
   return dialog.error('系统内部错误');
      }
  });
       });
});




//处理工单按钮
$('#solvework').click(function(){
layer.confirm('您确定要接受处理这个工单？', {
mybtn: ['确定','取消'] //按钮
},function(){
  var url =SCOPE.save_url;
var status = document.getElementById('status').value;
//工单ID
var gid = document.getElementById('getid').value;
//处理人ID
var sid = document.getElementById('sid').value;
status = 1;
var data = new FormData();
data.append('status',status);
 data.append('id',gid);
  data.append('sid',sid);
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

 return dialog.success('接受成功',jumpurl);
      },
      error:function(dat){
   return dialog.error('系统内部错误');
      }
  });
  

       });

      });

//发送留言
$('#btnl').click(function(){
  //工单ID
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



//设置工单级别和状态
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
