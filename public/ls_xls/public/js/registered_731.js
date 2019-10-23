$(function() {
	//发送验证
	$(".yzm_btn").click(function() {
		$(".yzm_btn").prop("disabled",true);
		var phone = $(".username_1").val();
		if(!phone) {
			alert("请填写手机号码");
			$(".yzm_btn").prop("disabled",false);
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
					$(".yzm_btn").find("span").html(time + "秒后重发");
					setInterval(function() {
						time--;
						if(time === 0) {
							$(".yzm_btn").find("span").html("获取验证码");
							$(".yzm_btn").prop("disabled",false);
						} else if(time > 0) {
							$(".yzm_btn").find("span").html(time + "秒后重发");
						}
					}, 1000);

				} else {
					isErr(result);
					$(".yzm_btn").prop("disabled",false);
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
			var wx_account = $(".wx_account_1").val();
			var username = $(".username_1").val();
			var account_name = $(".account_name_1").val();
		//	var code = $(".code").val();
			var pwd1 = $(".pwd1_1").val();
			var pwd2 = $(".pwd2_1").val();
			var reffer_code=$(".reffer_code").val();
			var d = {};
			
			if(!username) {
				alert("请输入手机号码");
				prevent_repetition = true;
				return false;
			}	
//			if(!code) {
//				alert("请输入验证码");
//				prevent_repetition = true;
//				return false;
//			}
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
		//	if(!wx_account) {
		//		alert("请输入微信号");
		//		prevent_repetition = true;
		//		return false;
		//	}
			if(!pwd1) {
				alert("请输入登录密码");
				prevent_repetition = true;
				return false;
			}
			if(!pwd2) {
				alert("请再次输入登录密码");
				prevent_repetition = true;
				return false;
			}
			if(pwd2 != pwd1) {
				alert("两次密码输入不一致");
				prevent_repetition = true;
				return false;
			}
			d.wx_account=wx_account;
			d.username = username;
			d.account_name = account_name;
			//d.code = code;
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