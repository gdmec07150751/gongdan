var imgSrc1 = []; //图片路径
var imgFile1 = []; //文件流
var imgName1 = []; //图片名字
var fileobj1 = [];

//选择图片

function fileUpload(obj) {
	var oInput1 = '#' + obj.inputId;
	var imgfBox = '#' + obj.imgfBox;
	var btn1 = '#' + obj.buttonId;
	//alert(imgBox);
	
	$(oInput1).on("change", function() {

		var fileImg1 = $(oInput1)[0];
		var fileList1 = fileImg1.files;
		var FORMAT = $(oInput1).val().substr($(this).val().length - 3, 3);
		if (FORMAT != "doc" && FORMAT != "xls" && FORMAT != "mp4"&& FORMAT != "avi"&& FORMAT != "ocx" && FORMAT != "lsx") {
        	//'doc', 'xls', 'mp4', 'avi', 'docx', 'xlsx'
        	dialog.error("文件格式不正确！！！支持'doc', 'xls', 'mp4', 'avi', 'docx', 'xlsx'格式");
        	return;
        }
       var fileww = this.files[0];//获取file文件对象
        if (fileww.size == 0) {
            dialog.error("不能上传空文件");
            return;
        }

        for(var i = 0; i < fileList1.length; i++) {
 var imgSrcI1 = getObjectURL1(fileList1[i]);
 imgName1.push(fileList1[i].name);
 imgSrc1.push(imgSrcI1);
 imgFile1.push(fileList1[i]);
 fileobj1.push($('#filef')[0].files[i]);
		}


		if(imgFile1.length>-1){
     document.getElementById("btnf").style.display="block";
 }


		addNewContent1(imgfBox);
	})
	$(btn1).on('click', function() {

    if(fileobj1.length == 0){
    	dialog.error("请选择文件");
        	return;
    }

      		    var size = [];
		    for (var k = 0, length = imgFile1.length; k < length; k++) {
                      size.push(imgFile1[k].size);
            }

		    var filesize = size.join('|');
		    var filename = imgName1.join('|');
var data1 = new FormData();
data1.append('filesize',filesize);
data1.append('filename',filename);

		for (var i=0; i<fileobj1.length;i++) {
			data1.append('filef[]',fileobj1[i]);
		}

		fileobj1= [];

submitPicture1(obj.upUrl,data1);



		
		
	})
}
//图片展示
function addNewContent1(obj) {
	//console.log(imgName1);
	//imgname3 = imgName1;
	$(imgfBox).html("");
	var imgNametwo = imgName1;
	for(var a = 0; a < imgSrc1.length; a++) {
         /*  if(imgNametwo[a].length>10){
           	imgNametwo[a] = imgNametwo[a].substr(0,5)+'...'+imgNametwo[a].substr(-6,6);
          
           }
*/
		var oldBox1 = $(obj).html();
		$(obj).html( oldBox1+'<div class="imgContainer1"><a href="'+imgSrc1[a]+'">'+imgNametwo[a]+'</a>&nbsp&nbsp&nbsp<span onclick="removeImg1(this,' + a + ')" class="imgDelete">删除</span></div><br>');

/*	'<div class="imgContainer1"><img '+
			'title=' + imgNametwo[a] + '  src="../../../Public/images/txt.jpg" onclick'+
			'="imgDisplay1(this)">'+
			'<p onclick="removeImg1(this,' + a + ')" class="imgDelete">删除</p>'+
			'</div>'*/
	}
}
//删除
function removeImg1(obj, index) {

	if(imgFile1.length==1){
		document.getElementById("btnf").style.display="none";
		document.getElementById("filef").value=null;
	}
	imgSrc1.splice(index, 1);
	imgFile1.splice(index, 1);
	imgName1.splice(index, 1);
	fileobj1.splice(index,1);

	var boxId1 = "#" + $(obj).parent('.imgContainer1').parent().attr("id");
	addNewContent1(boxId1);

}





//上传(将文件流数组传到后台)
function submitPicture1(url,data) {
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
		    $(".fileid").attr("value",dat);
            //console.log($(".fileid").val());
		    imgSrc1 = []; 
          	imgFile1 = []; 
          	imgName1 = []; 
          	fileobj1 = [];
          	//document.getElementById("filef").value=null;
          	//data1.delete('file[]');
          	document.getElementById("btnf").style.display="none";
          return dialog.successf('上传成功');

      },
      error:function(dat){
   return dialog.error('上传失败，系统内部错误');
      }
  });
	}
}
//图片灯箱
function imgDisplay1(obj) {
	var src1 = $(obj).attr("src");
	var imgHtml1 = '<div style="width: 100%;height: 100vh;overflow: auto;background: rgba(0,0,0,0.5);text-align: center;position: fixed;top: 0;left: 0;z-index: 1000;"><img src=' + src1 + ' style="margin-top: 100px;width: 70%;margin-bottom: 100px;"/><p style="font-size: 50px;position: fixed;top: 30px;right: 30px;color: white;cursor: pointer;" onclick="closePicture1(this)">×</p></div>'
	$('body').append(imgHtml1);
}





//关闭
function closePicture1(obj) {
	$(obj).parent("div").remove();
}

//图片预览路径
function getObjectURL1(file) {
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