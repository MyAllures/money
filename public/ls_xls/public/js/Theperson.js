$(function(){
	personal_data(1);
	

//	修改昵称
	var prevent_repetition = true;
	$(".personal_b").on("click", function() {
		if(prevent_repetition) {
			prevent_repetition = false;
			var age = $(".age1").val();
			var age1 = $(".age1").attr("data");
			var profession = $(".profession1").val();
			var profession1 = $(".profession1").attr("data");
			var sex=$("input[type='radio']:checked").val();			
			var nickname = $(".nickname").val();
			var nickname1 = $(".nickname").attr("data");
			var wx_picture_id = $(".wx_picture_id1").val();
			var wx_picture_id1 = $(".wx_picture_id1").attr("data");
			var d = {};
//			没修过不上传
			if(nickname != nickname1){
				d.nickname=nickname;
			}
			if(age != age1){
				d.age=age;
			}
			if(profession != profession1){
				d.profession=profession;
			}
			if(!nickname) {
				alert("请输入昵称");
				prevent_repetition = true;
				return false;
			}

			d.token = token;
			d.sex=sex;
			console.log(sex);
			$.ajax({
				type: "post",
				url: url + '/api.php/User/editProfile',
				data: d,
				dataType: 'json',
				success: function(result) {
					if(result.code == '0000') {
						alert(result.msg);
						location.href="my.html";
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
	      	url: url+'/api.php/tool/head',
	  		type: 'POST',  
	        data: formData,
	        async: false,  
	        cache: false,  
	        contentType: false,  
	        processData: false, 
	        dataType:"json",
	        success: function (result) {
	        	if(result.code == '0000'){
		        	alert(result.msg);
		        	$(".head_icon").attr("src",result.data.url);
		        }else{
		            isErr(result);
		        }
	        }
	    });  
	}

	
})
