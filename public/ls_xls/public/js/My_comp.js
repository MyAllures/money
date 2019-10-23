$(function(){
	var you=GetQueryString("ts_type");
	var apply_id=GetQueryString("apply_id");
	var type_tc=GetQueryString("type_tc");
	if(you == "1"){
		$("#ts_btn").html("确认撤诉");
		$(".title_1").attr("readonly","readonly");
		$(".content_1").attr("readonly","readonly");
		$("#form1").css("display","none");
	}else if(you == "2"){
		$(".ts_div").css("display","none");
		$(".title_1").attr("readonly","readonly");
		$(".content_1").attr("readonly","readonly");
		$("#form1").css("display","none");
	}
	
//	获取投诉信息
	$.ajax({
		type: "post",
		url:url + '/api.php/Up/getComplainInfo',
		async: false,
		data:{"token":token,"apply_id":apply_id},
		dataType: 'json',
		success: function(result) {
			if(result.code == '0000') {
				var data=result.data;
				if(type_tc != "ts"){
					$(".name_1").html(data.up_user.code);
					$(".phone_1").html(data.up_user.phone).attr("data-url",data.up_user.phone);
					$(".wx_account_1").html(data.up_user.wx_account).attr("data-url",data.up_user.wx_account);
					if(data.up_user.head_icon != ""){
						$(".upg3t3lep img").attr("src",data.up_user.head_icon);
					}
				}else{
					$(".name_1").html(data.apply_user.code);
					$(".phone_1").html(data.apply_user.phone).attr("data-url",data.apply_user.phone);
					$(".wx_account_1").html(data.apply_user.wx_account).attr("data-url",data.apply_user.wx_account);
					if(data.apply_user.head_icon != ""){
						$(".upg3t3lep img").attr("src",data.apply_user.head_icon);
					}
				}
				if(you != "0"){
					$(".title_1").val(data.commlain.title);
					$(".content_1").val(data.commlain.content);
					var  data1=data.commlain.img_list;
					var html = '';
					console.log(data1);
					for(var i in data1){
						html += '<div class="del_div"><img class="feedback4" src="'+data1[i]+'" alt="" /></div>';
					}
					$(".up_div_img").append(html);
				}
			} else {
				isErr(result);
			}
		},			
	})
	$(".weixin_ip").on("click",function(){
		if($(this).attr("data-url") != undefined){
			$("#foo").val($(this).attr("data-url"));
		}
	})
	
	
//	复制文本
	var u = navigator.userAgent;
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
    if(isiOS) {
        var clipboard = new Clipboard(".weixin_ip");
        clipboard.on("success", function(e) {
		    alert('复制成功'); 		 
		    e.clearSelection(); 
        })
    } else {
        $(".weixin_ip").on("click",function(){
	        var text = $(this).attr("data-url");
	        var oInput = document.createElement('input');
	        oInput.value = text;
	        document.body.appendChild(oInput);
	        oInput.select(); // 选择对象
	        document.execCommand("Copy"); // 执行浏览器复制命令
	        oInput.className = 'oInput';
	        oInput.style.display = 'none';
	        alert('复制成功');
			return false;
	    })
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
	
//	投诉and撤诉
	var prevent_repetition = true;
	$("#ts_btn").on("click",function(){
		if(you == "0"){
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
				d.img_ids=JSON.stringify(arr);
				d.apply_id=apply_id;
				$.ajax({
					type: "post",
					url: url + '/api.php/Up/complain',
					data: d,
					dataType: 'json',
					success: function(result) {
						if(result.code == '0000') {
							alert(result.msg);
							location.href='audit_up.html';
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
		}else{
			var d={};
				d.token=token;
				d.apply_id=apply_id;
				$.ajax({
					type: "post",
					url: url + '/api.php/Up/cancelComplain',
					data: d,
					dataType: 'json',
					success: function(result) {
						if(result.code == '0000') {
							alert(result.msg);
							location.href='audit_up.html';
						} else {
							isErr(result);
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						alert("请求失败：" + XMLHttpRequest.status);
					}
				});
		}
	})
})
