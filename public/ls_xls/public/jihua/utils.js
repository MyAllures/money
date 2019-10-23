var utils = {
    //验证表单
    is_from: function (formId,callback) {
        var form = document.getElementById(formId);
        var elements = new Array();
        var tagElements = form.getElementsByTagName('input');
        for (var j = 0; j < tagElements.length; j++) {
            elements.push(tagElements[j]);
        }
        //判断数据是否为空
        var data = {}
        for (var item in elements) {
            if (elements[item].getAttribute("format") == "empty") {
                if (elements[item].value == "") {
                    $.toast.prototype.defaults.duration = 2000;
                    $.toast(elements[item].getAttribute("f-name"), "text");
                    //提示要填
                    return false;
                }
            }
            data[elements[item].name] = elements[item].value
        }
        callback(data);
    },
    getUrlParam: function (name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg);  //匹配目标参数
        if (r != null) return unescape(r[2]); return null; //返回参数值
    },
    TextCopy:function (text) {
	    var input = document.createElement("input");
	    input.value = text;
	    document.body.appendChild(input);
	    input.select();
	    input.setSelectionRange(0, input.value.length), document.execCommand('Copy');
	    $.toast.prototype.defaults.duration = 2000;
	    $.toast("复制成功", "text");
	    //提示要填
	    return false;
	},
	upload:upload,//上传图片
}


//上传图片
//obj:上传图片的按钮ID
function upload(obj,callback)
{
	var filePath = $(obj).val(), //获取到input的value，里面是文件的路径
		fileFormat = filePath.substring(filePath.lastIndexOf(".")).toLowerCase(),
		imgBase64 = '', //存储图片的imgBase64
		fileObj = document.getElementById($(obj).attr("ID")).files[0]; //上传文件的对象,要这样写才行，用jquery写法获取不到对象
	
	// 检查是否是图片
	if (!fileFormat.match(/.png|.jpg|.jpeg/)) {
		alert('上传错误,文件格式必须为：png/jpg/jpeg');
		return;
	}
	
	// 调用函数，对图片进行压缩
	compress(fileObj, function(imgBase64) {
		imgBase64 = imgBase64; //存储转换的base64编码
		//$('#viewImg').attr('src', imgBase64); //显示预览图片
		//上传图片
		config.upload(imgBase64,function(msg){
			callback(msg);
		})
	});
	
	// 不对图片进行压缩，直接转成base64
	function directTurnIntoBase64(fileObj, callback) {
		var r = new FileReader();
		// 转成base64
		r.onload = function() {
			//变成字符串
			imgBase64 = r.result;
			console.log(imgBase64);
			callback(imgBase64);
		}
		r.readAsDataURL(fileObj); //转成Base64格式
	}
	
	// 对图片进行压缩
	function compress(fileObj, callback) {
		if (typeof(FileReader) === 'undefined') {
			console.log("当前浏览器内核不支持base64图标压缩");
			//调用上传方式不压缩  
			directTurnIntoBase64(fileObj, callback);
		} else {
			try {
				var reader = new FileReader();
				reader.onload = function(e) {
					var image = $('<img/>');
					image.load(function() {
						square = 700, //定义画布的大小，也就是图片压缩之后的像素
							canvas = document.createElement('canvas'),
							context = canvas.getContext('2d'),
							imageWidth = 0, //压缩图片的大小
							imageHeight = 0,
							offsetX = 0,
							offsetY = 0,
							data = '';
	
						canvas.width = square;
						canvas.height = square;
						context.clearRect(0, 0, square, square);
	
						if (this.width > this.height) {
							imageWidth = Math.round(square * this.width / this.height);
							imageHeight = square;
							offsetX = -Math.round((imageWidth - square) / 2);
						} else {
							imageHeight = Math.round(square * this.height / this.width);
							imageWidth = square;
							offsetY = -Math.round((imageHeight - square) / 2);
						}
						context.drawImage(this, offsetX, offsetY, imageWidth, imageHeight);
						var data = canvas.toDataURL('image/jpeg');
						//压缩完成执行回调  
						callback(data);
					});
					image.attr('src', e.target.result);
				};
				reader.readAsDataURL(fileObj);
			} catch (e) {
				console.log("压缩失败!");
				//调用直接上传方式  不压缩 
				directTurnIntoBase64(fileObj, callback);
			}
		}
	}
}


