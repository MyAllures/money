$(function() {
	//发送验证
	$(".yan_btn").click(function() {
		$(".yan_btn").prop("disabled",true);
		var phone = $(".username_1").val();
		if(!phone) {
			alert("请填写手机号码");
			$(".yan_btn").prop("disabled",false);
			return false;
		}
		var d = {};
		d.phone = phone;
		d.type="registe";
		$.ajax({
			type: "post",
			url: url + '/api.php/sms/send.html',
			data: d,
			dataType: 'json',
			success: function(result) {
				if(result.code == '0000') {
					//倒计时
					var time = result.data.time;
					$(".yan_btn").html(time + "秒后重发");
					setInterval(function() {
						time--;
						if(time === 0) {
							$(".yan_btn").html("获取验证码");
							$(".yan_btn").prop("disabled",false);
						} else if(time > 0) {
							$(".yan_btn").html(time + "秒后重发");
						}
					}, 1000);

				} else {
					isErr(result);
					$(".yan_btn").prop("disabled",false);
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert("请求失败：" + XMLHttpRequest.status);
			}
		});

	});
//	所属代理 有的话就不显示推荐人
	var agent_code=GetQueryString("agent_code");
	if(agent_code == "" || agent_code == null || agent_code == undefined){
		
	}else{
		$(".tjr_hm").css("display","none");
	}
//	推荐人
	var reffer_code = GetQueryString("reffer_code");
	if(reffer_code == "" || reffer_code == null || reffer_code == undefined){
		
	}else{
		$(".reffer_code").prop("readonly","readonly");
		$(".reffer_code").val(reffer_code);
	}
	//	帮助注册
	var prevent_repetition = true;
	$(".login_bt1n").on("click", function() {
		if(prevent_repetition) {
			prevent_repetition = false;
			var username = $(".username_1").val();
			var pwd1 = $(".pwd1_1").val();
			var reffer_code=$(".reffer_code").val();
			var d = {};
			
			if(!username) {
				alert("请输入手机号码");
				prevent_repetition = true;
				return false;
			}	
//			推荐人 有的话就直接赋值不能修改,没有且没有所属代理就必填
			reffer_code=$(".reffer_code").val();
			if($(".tjr_hm").css("display") != "none"){
				if(!reffer_code){
					alert("请输入推荐人号码");
					prevent_repetition = true;
					return false;
				}
				d.reffer_code=reffer_code;
			}else{
				d.agent_code=agent_code;
			}
			if(!pwd1) {
				alert("请输入登录密码");
				prevent_repetition = true;
				return false;
			}
			d.username = username;
			d.pwd = pwd1;
			d.reffer_code=reffer_code;
			$.ajax({
				type: "post",
				url: url + '/api.php/User/reg',
				data: d,
				dataType: 'json',
				success: function(result) {
					if(result.code == '0000') {
						alert(result.msg);
						window.location.href="../index.html";
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