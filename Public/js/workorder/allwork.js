 function checkAll() {  


        var all=document.getElementById('allselect');

        var one=document.getElementsByName('dcheckbox');

        if(all.checked==true){ 

          for(var i=0;i<one.length;i++){  
            one[i].checked=true;  
          }  

        }
        else
        {  
          for(var j=0;j<one.length;j++){  
            one[j].checked=false;  
          }  
        } 


      } 

$('.singcms-table #checkone').click(function(){
  var id = $(this).attr('attr-id');
    var url = SCOPE.edit_url+"&id="+id;
  window.location.href  = url;
});

//删除
      $('#mybtn').click(function(){

        var darr=[];
        var cb = document.getElementsByName('dcheckbox');
        var len =cb.length;
        for(var i = 0;i<len;i++){
          if(cb[i].checked){
            darr.push(cb[i].value);
          }
        }
   //alert(darr);
  if(darr.length == 0){
          dialog.error('你没有选中任何工单');
              return;
        }
//dialog.confirm('确认要删除选中的'+darr.length+'个工单?',url);
layer.confirm('您确定要删除选中的'+darr.length+'个工单？', {
mybtn: ['确定','取消'] //按钮
},function(){
        var data = new FormData();
        data.append('idarr',darr);
        var url = SCOPE.save_url;
        var jumpurl = SCOPE.jump_url
        $.ajax({
          type: "POST",
          cache: false,
          processData: false,
          contentType: false,
          async: false,
          url:url,
          data: data,
          success: function(dat) {
  
            return dialog.success('删除成功',jumpurl);

          },
          error:function(dat){
           return dialog.error('系统内部错误');
         }
       });

      }
      );
      });

$('#btn1').click(function(){
  var statu = document.getElementById('checkstatus');
  var status = statu.value;
  var rank = document.getElementById('checkrank').value;
  var leibie  = document.getElementById('checkleibie').value;
if(status==0&&rank==0&&leibie==0){
  var url = SCOPE.edit2_url;
}else{
var url = SCOPE.edit2_url+"&status="+status+"&rank="+rank+"&leibie="+leibie;
}
  window.location.href  = url;
  
        });

