$(function() {
	//发送验证
	$(".yan_btn").click(function() {
		$(".yan_btn").prop("disabled",true);
		var phone = $("#phone").val();
		if(!phone) {
			alert("请填写手机号码");
			$(".yan_btn").prop("disabled",false);
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
	var prevent_repetition = true;
	$(".submit_btn").on("click", function() {
		if(prevent_repetition) {
			prevent_repetition = false;
			var username = $("#phone").val();
			var pwd1 = $("#password").val();
			var pwd2 = $("#password1").val();
			var reffer_code=$(".reffer_code").val();
			var d = {};
			
			if(!username) {
				alert("请输入手机号码");
				prevent_repetition = true;
				return false;
			}
			if(!pwd1) {
				alert("请输入新密码");
				prevent_repetition = true;
				return false;
			}
			if(!pwd2) {
				alert("请再次输入新密码");
				prevent_repetition = true;
				return false;
			}
			if(pwd2 != pwd1) {
				alert("两次密码输入不一致");
				prevent_repetition = true;
				return false;
			}
			d.phone = username;
			d.pwd = pwd1;
			d.code=reffer_code;
			$.ajax({
				type: "post",
				url: url + '/api.php/User/find_pwd',
				data: d,
				dataType: 'json',
				success: function(result) {
					console.log(result);
					if(result.code == '0000') {
						alert(result.msg);
						window.location.href="../yq/login.html";
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