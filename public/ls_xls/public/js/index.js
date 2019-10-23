$(function(){
//	获取用户信息
	$.ajax({
		type: "post",
		url: url + '/api.php/User/getProfile',
		data: {"token":token,"show_type":1},
		dataType: 'json',
		success: function(result) {
			if(result.code == '0000') {
				var data=result.data;
				$(".nickname").html(data.nickname);
				$(".username").html(data.username);
				$(".code").html(data.code);
				$(".score_amount").html(data.score_amount);
				$(".score").html(data.score);
				$(".team_num_v").html("我的粉丝："+data.count_info.team_num);
				$(".level_name").html(data.level_name);
				$(".can_reg").attr("data",data.can_reg);
				if(data.head_icon != ""){
					$(".head_icon").attr("src",data.head_icon);
				}
				
				if(data.count_info.is_signed == "0"){
					$(".is_signed").html("未签到");
				}else{
					$(".is_signed").html("已签到");
				}
				
//				判断审核信息
				if(data.count_info.wait_verify_upgrade != 0){
					$(".red_dian").css("display","block");
				}
			}else{
				location.href='login.html';
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("请求失败：" + XMLHttpRequest.status);
		}
	});
	
	
//	公告轮播
	$.ajax({
		type: "post",
		url: url + '/api.php/tool/message',
		data: {"token":token},
		dataType: 'json',
		success: function(result) {
			if(result.code == '0000') {
				var data=result.data.list;
				var html= '';
				for(var i in data){
					html += '<li>'+data[i].content+'</li>';
					html += '<li>'+data[i].content+'</li>';
				}
				$(".infoList").html(html);
				//公告轮播
				jQuery(".txtMarquee-top").slide({mainCell:".bd ul",autoPlay:true,effect:"top",vis:1,mouseOverStop:false});
			}else{
				location.href='login.html';
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("请求失败：" + XMLHttpRequest.status);
		}
	});
	
//	首页弹窗公告
//	var repetition_index=localStorage.getItem("repetition_index");
//	if(repetition_index == "1"){
//		$.ajax({
//			type: "post",
//			url: url + '/api.php/common/getlastNotice',
//			data: {"token":token},
//			dataType: 'json',
//			success: function(result) {
//				if(result.code == '0000') {
//					var data=result.data.list;
//					$(".immediately_title").html(data.name);
//					$(".immediately_centent").html(data.describe);
//					$("#aaa").css("display","block");
//					$("#ddd").css("display","block");
//					localStorage.setItem("repetition_index","2");
//				}else{
//					location.href='login.html';
//				}
//			},
//			error: function(XMLHttpRequest, textStatus, errorThrown) {
//				alert("请求失败：" + XMLHttpRequest.status);
//			}
//		});
//	}
	
	
//	取消弹框
	$("#aaa").on("click",function(){
		$("#aaa").css("display","none");
		$("#ddd").css("display","none");
	})
	
	
//	邀请好友
	$(".can_reg").on("click",function(){
		if($(this).attr("data") == "1"){
			location.href="my_invite.html";
		}else{
			alert("暂无权限邀请好友");
		}
	})
})
