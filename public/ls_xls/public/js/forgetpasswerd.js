$(function() {

	//发送验证
	$(".yzm_btn").click(function() {
		$(".yzm_btn").prop("disabled",true);
		var phone = $(".username").val();
		if(!phone) {
			alert("请填写手机号码");
			$(".yzm_btn").prop("disabled",false);
			return false;
		}
		var d = {};
		d.phone = phone;
		d.type="find_pwd";
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
	//	注册
	var prevent_repetition = true;
	$(".login_bt1n").on("click", function() {
		if(prevent_repetition) {
			prevent_repetition = false;
			var username = $(".username").val();
			var code = $(".code").val();
			var pwd1 = $(".pwd1").val();
			var pwd2 = $(".pwd2").val();
			
			var d = {};
			if(!username) {
				alert("请填写手机号码");
				prevent_repetition = true;
				return false;
			}
			if(!code) {
				alert("请输入验证码");
				prevent_repetition = true;
				return false;
			}
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
			d.phone = username;
			d.code = code;
			d.pwd = pwd1;
			$.ajax({
				type: "post",
				url: url + '/api.php/User/find_pwd',
				data: d,
				dataType: 'json',
				success: function(result) {
					if(result.code == '0000') {
						alert(result.msg);
						location.href="login.html";
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