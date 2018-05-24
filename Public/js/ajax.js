/*$('#new').click(function(){
    //获取Form表单数据
    var data = $('#form1').serializeArray();
    //创建数组把数据存起来
    postdata = {} ;
    $(data).each(function(i){
        postdata[this.name] = this.value;
    });
   console.log(postdata);
  url = SCOPE.save_url;
   jump_url = SCOPE.jump_url;
    $.post(url,postdata,function(result){
    if(result.status == 0){
        //失败
        return dialog.error(result.message);
    }else if(result.status==1){
        //成功
        return dialog.success(result.message,jump_url);
     }
    },"json");
});*/