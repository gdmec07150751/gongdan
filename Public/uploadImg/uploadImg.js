var imgSrc = []; //图片路径
var imgFile = []; //文件流
var imgName = []; //图片名字
var fileobj = [];
var data = new FormData();
//选择图片
function imgUpload(obj) {
	var oInput = '#' + obj.inputId;
	var imgBox = '#' + obj.imgBox;
	var btn = '#' + obj.buttonId;	
	//选择一张图片后
	$(oInput).on("change", function() {
		var fileImg = $(oInput)[0];
		var fileList = fileImg.files;
		//验证图片格式
    	var FORMAT = $(oInput).val().substr($(this).val().length - 3, 3);
	if (FORMAT != "jpg" && FORMAT != "gif" && FORMAT != "png"&& FORMAT != "peg"&& FORMAT != "bmp") {
        	dialog.error("文件格式不正确！！！支持'jpg', 'gif', 'png', 'jpeg', 'bmp'格式");
        	return;
        }

        //验证图片是否空
       var fileww = this.files[0];//获取file文件对象
        if (fileww.size == 0) {
            dialog.error("不能上传空文件");
            return;
        }
       
       //将图片加在一起
		for(var i = 0; i < fileList.length; i++) {
			var imgSrcI = getObjectURL(fileList[i]);
			imgName.push(fileList[i].name);
			imgSrc.push(imgSrcI);
			imgFile.push(fileList[i]);
			fileobj.push($('#file')[0].files[i]);

		}
		//上传按钮是否显示
		if(imgFile.length>-1){
     document.getElementById("btn").style.display="block";
 }
        //展示图片
		addNewContent(imgBox);
	})

	//判断是否没有选择图片
	$(btn).on('click', function() {
		  if(fileobj.length == 0){
    	dialog.error("请选择图片");
        	return;
    }

		    //数据处理 大小 名字 等
		     var size = [];
		    for (var k = 0, length = imgFile.length; k < length; k++) {
                      size.push(imgFile[k].size);
            }
		    var imgsize = size.join('|');
		    var imgname = imgName.join('|');
var data = new FormData();
         data.append('imgsize',imgsize);
         data.append('imgname',imgname);
        
		for (var i=0; i<fileobj.length;i++) {
			data.append('file[]',fileobj[i]);
		}


          fileobj= [];
submitPicture(obj.upUrl, data);



	})
}
//图片展示
function addNewContent(obj) {
	$(imgBox).html("");
	var imgNametwo = imgName;
	for(var a = 0; a < imgSrc.length; a++) {
	/*	           if(imgNametwo[a].length>10){
           	imgNametwo[a] = imgNametwo[a].substr(0,5)+'...'+imgNametwo[a].substr(-6,6);
          
           }*/
		var oldBox = $(obj).html();
		$(obj).html(oldBox + '<div class="imgContainer"><img class="img-rounded" title=' +
		 imgName[a] + ' alt=' + imgName[a] + ' src=' + imgSrc[a] +
		  ' onclick="imgDisplay(this)"><p onclick="removeImg(this,' + a + ')"'+
		  ' class="imgDelete">删除</p>'+
		  '</div>');
	}
}
//删除
function removeImg(obj, index) {
	//上传按钮是否显示
	if(imgFile.length==1){
		document.getElementById("btn").style.display="none";
		document.getElementById("file").value=null;
	}

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
            //console.log($(".imgid").val());
                 imgSrc = []; 
            imgFile = []; 
            imgName = []; 
            fileobj = [];
	document.getElementById("btn").style.display="none";
		    //data.delete('file[]');
            return dialog.successf('上传成功');
			},
			error:function(dat){
	             return dialog.error('系统内部错误');
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