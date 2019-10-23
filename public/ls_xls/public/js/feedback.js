$(function(){
//	获取类型
	var you=GetQueryString("type");
	if(you != 2){
		you = 1;
	}
	
//	上传图片
	$(".imgg").on("click",function(){
		$("#file1").click();
	})
	$("input[type='file']").on("change",function(){
		doUpload();
	})
	//上传图片接口
	function doUpload() {
	 	var formData = new FormData($( "#form1")[0]);  
	 	formData.append("token",token);
	 	$.ajax({  
	      	url: url+'/api.php/tool/img_upload',
	  		type: 'POST',  
	        data: formData,
	        async: false,  
	        cache: false,  
	        contentType: false,  
	        processData: false, 
	        dataType:"json",
	        success: function (result) {
	        	if(result.code == '0000'){
		        	var html = '';
		        	html += '<div class="del_div" data="'+result.data.id+'"><img class="feedback4" src="'+result.data.url+'" alt="" /><img src="images/del_img1.png" class="del_img" alt="" /></div>';
		        	$(".up_div_img").append(html);
		        	if($(".up_div_img>div").length == 5){
		        		$("#form1").css("display","none");
		        	}
//			        	删除图片
		        	$(".del_img").on("click",function(){
		        		$(this).parent().remove();
		        	})
		        }else{
		            isErr(result);
		        }
	        }
	    });  
	}
	
//	意见反馈
	var prevent_repetition = true;
	$(".login_bt1n").on("click",function(){
		if(prevent_repetition){
			prevent_repetition=false;
			var title=$(".title_1").val();
			var content=$(".content_1").val();
			var arr=[];
			if(!title){
				alert("请输入标题")
				prevent_repetition = true;
				return false;
			}
			if(!content){
				alert("请输入内容")
				prevent_repetition = true;
				return false;
			}
			for(var i=0;i<$(".del_div").length;i++){
				arr.push($(".del_div").eq(i).attr("data"));	
			}
			var d={};
			d.token=token;
			d.title=title;
			d.content=content;
			d.img_ids=arr.join(",");
			d.type=you;
			$.ajax({
				type: "post",
				url: url + '/api.php/tool/suggestion',
				data: d,
				dataType: 'json',
				success: function(result) {
					if(result.code == '0000') {
						alert(result.msg);
						if(you != 2){
							location.href='Feedback_record.html?type='+you;
						}else{
							location.href='Complaint_record.html?type='+you;
						}
						
					} else {
						isErr(result);
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert("请求失败：" + XMLHttpRequest.status);
				},
				complete: function() {
					prevent_repetition = true;
				}
			});
		}
	})
})
