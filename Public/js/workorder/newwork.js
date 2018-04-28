 
  var um = UM.getEditor('myEditor',{initialFrameWidth: null});


   


  
  $('#new').click(function(){
      var title = document.getElementById('title').value;
      var rank = document.getElementById('level').value;
      var content = um.getContent();
      if(!title||title.length>10){
        return dialog.error('标题不能为空,且长度少于10');
      }
      if(!content){
        return dialog.error('内容不能为空');
      }

      var imgid = document.getElementById('imgid').value;
      var fileid = document.getElementById('fileid').value;  
      //console.log(imgid);
      //console.log(fileid);
      var data = new FormData();
      data.append('title',title);
      data.append('rank',rank);
      data.append('content',content);
      data.append('imgid',imgid);
      data.append('fileid',fileid);
      url = SCOPE.save_url
      jump_url = SCOPE.jump_url;

      $.ajax({
        type:'POST',
          //dataType:'json',
          cache: false,
          processData: false,
          contentType: false,
          async: false,
          url:url,
          data: data,
          success:function(result){
            return dialog.success("新建成功",jump_url);
          },
          error:function(result){
              //alert(result);
              return dialog.error("新建失败");
            }
          });
    });

