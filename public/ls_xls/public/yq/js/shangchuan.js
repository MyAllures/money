function previewImg(input,obj) {
	//var baseUrl = 'http://www.ihnha.cn/';
        if(input.files && input.files[0]) {
            var reader = new FileReader(),
                    img = new Image();
            reader.onload = function (e) {
                if(input.files[0].size>3072000){//图片大于300kb则压缩
                    img.src = e.target.result;
                    img.onload=function(){
//                      compress(img);
                    }
                }else{
                    var blob = e.target.result;
					//alert(blob);
                    $.ajax({
                        type: 'POST',
                        url:"http://www.pr175.cn/index.php/upload/saveBase64Image",
                        dataType: "json",
                        data: {
                           file: blob,
                        },
                        success: function(data) {
                        	if(data.code==0){
                        		$(obj).attr('src1',data.url)
                        		$(obj).attr('src',data.url)
        					}else{
        						mui.toast(data.msg)
        					}

                        },
                        error: function(data) {
							alert(data.code);
                        	mui.toast('网络错误'+data.msg)
                        }
                    });

                }
            };
            reader.readAsDataURL(input.files[0]);
            return 1;
        }
    }