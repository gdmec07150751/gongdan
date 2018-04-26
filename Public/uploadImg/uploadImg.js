var imgSrc = []; //图片路径
var imgFile = []; //文件流
var imgName = []; //图片名字
var fileobj = [];
var data = new FormData();
var pg=document.getElementById('pg');
//选择图片
var count=0;

function imgUpload(obj) {
	var oInput = '#' + obj.inputId;
	var imgBox = '#' + obj.imgBox;
	var btn = '#' + obj.buttonId;
	//alert(imgBox);
	
	$(oInput).on("change", function() {
		count=0;
  
		var fileImg = $(oInput)[0];
		var fileList = fileImg.files;
    	var FORMAT = $(oInput).val().substr($(this).val().length - 3, 3);
		  //console.log(FORMAT);
	if (FORMAT != "jpg" && FORMAT != "gif" && FORMAT != "png"&& FORMAT != "peg"&& FORMAT != "bmp") {
        	//'jpg', 'gif', 'png', 'jpeg', 'bmp'
        	dialog.error("文件格式不正确！！！支持'jpg', 'gif', 'png', 'jpeg', 'bmp'格式");
        	return;
        }
       var fileww = this.files[0];//获取file文件对象
        if (fileww.size == 0) {
            dialog.error("不能上传空文件");
            return;
        }

		for(var i = 0; i < fileList.length; i++) {
			var imgSrcI = getObjectURL(fileList[i]);
			imgName.push(fileList[i].name);
			imgSrc.push(imgSrcI);
			imgFile.push(fileList[i]);
			fileobj.push($('#file')[0].files[i]);

		}

		addNewContent(imgBox);
	})
	$(btn).on('click', function() {
		  if(fileobj.length == 0){
    	dialog.error("请选择图片");
        	return;
    }

		    data.delete('file[]');
		     var size = [];
		    for (var k = 0, length = imgFile.length; k < length; k++) {
                      size.push(imgFile[k].size);
            }

		    var imgsize = size.join('|');
		    var imgname = imgName.join('|');

data.append('imgsize',imgsize);
data.append('imgname',imgname);
		for (var i=0; i<fileobj.length;i++) {
			data.append('file[]',fileobj[i]);
		}

fileobj= [];

    document.getElementById("wrapper").style.display="block";
        var fill=document.getElementById('fill');
        
    //通过间隔定时器实现百分比文字效果,通过计算CSS动画持续时间进行间隔设置
        var timer=setInterval(function(e){
            count++;
            fill.innerHTML=count+'%';
            if(count===100) {
            	clearInterval(timer);
submitPicture(obj.upUrl, data);
document.getElementById("wrapper").style.display="none";
            		}
        },17);
		//var data = new Object;
		//data[obj.data] = imgFile;
	  

	})
}
//图片展示
function addNewContent(obj) {
	$(imgBox).html("");
	var imgNametwo = imgName;
	for(var a = 0; a < imgSrc.length; a++) {
		           if(imgNametwo[a].length>10){
           	imgNametwo[a] = imgNametwo[a].substr(0,5)+'...'+imgNametwo[a].substr(-6,6);
          
           }

		var oldBox = $(obj).html();
		$(obj).html(oldBox + '<div class="imgContainer"><img title=' +
		 imgName[a] + ' alt=' + imgName[a] + ' src=' + imgSrc[a] +
		  ' onclick="imgDisplay(this)"><p onclick="removeImg(this,' + a + ')"'+
		  ' class="imgDelete">删除</p>'+
          '<q class="imgDelete"><strong>'+imgNametwo[a]+'</strong></q>'+
		  '</div>');
	}
}
//删除
function removeImg(obj, index) {

	imgSrc.splice(index, 1);
	imgFile.splice(index, 1);
	imgName.splice(index, 1);
	fileobj.splice(index,1);

	var boxId = "#" + $(obj).parent('.imgContainer').parent().attr("id");
	addNewContent(boxId);

}
//上传(将文件流数组传到后台)
function submitPicture(url,data) {

	//alert('请打开控制台查看传递参数！');
	if(url&&data){
		$.ajax({
			type: "POST",
         cache: false,
          processData: false,
          contentType: false,
          async: false,
          url:url,
          data: data,
   
			success: function(dat) {



	    $(".imgid").attr("value",dat);
            console.log($(".imgid").val());
                 imgSrc = []; 
            imgFile = []; 
            imgName = []; 
            fileobj = [];
		    fileobj = [];
		    data.delete('file[]');
            return dialog.successf('上传成功');
			},
			error:function(XMLHttpRequest, textStatus, errorThrown){
				console.log(XMLHttpRequest.status);
                console.log(XMLHttpRequest.readyState);
                console.log(textStatus);
			}
		});
	}
}
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

//图片预览路径
function getObjectURL(file) {
	var url = null;
	if(window.createObjectURL != undefined) { // basic
		url = window.createObjectURL(file);
	} else if(window.URL != undefined) { // mozilla(firefox)
		url = window.URL.createObjectURL(file);
	} else if(window.webkitURL != undefined) { // webkit or chrome
		url = window.webkitURL.createObjectURL(file);
	}
	return url;
}